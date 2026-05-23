<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('staff');

        if ($s = $request->search) {
            $query->where('first_name', 'ilike', "%$s%")
                  ->orWhere('last_name', 'ilike', "%$s%")
                  ->orWhere('staff_no', 'ilike', "%$s%");
        }

        if ($b = $request->branch_no) {
            $query->where('branch_no', $b);
        }

        $staff = $query->orderBy('branch_no')->orderBy('last_name')->paginate(10);
        $branches = DB::table('branches')->get();

        return view('staff.index', compact('staff', 'branches'));
    }

    public function create()
    {
        $branches = DB::table('branches')->orderBy('branch_no')->get();
        // Supervisors can be Managers or Supervisors
        $supervisors = DB::table('staff')->whereIn('job_title', ['Manager', 'Supervisor'])->get();

        return view('staff.create', compact('branches', 'supervisors'));
    }

    public function store(Request $request)
    {
        // SECURITY CHECK: Managers cannot hire other Managers. Only Super Admins can do this.
        if (auth()->user()->hasRole('Manager') && $request->job_title === 'Manager') {
            return back()->withErrors(['job_title' => 'Security Alert: You do not have clearance to hire System Managers. Please contact a Super Admin.'])->withInput();
        }

        $request->validate([
            // Staff Details
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'address'      => 'required|string|max:250',
            'telephone_no' => 'required|string|max:20',
            'sex'          => 'required|in:M,F',
            'dob'          => 'required|date',
            'nin'          => 'required|string|max:20|unique:staff,nin',
            'job_title'    => 'required|string|max:50',
            'salary'       => 'required|numeric|min:0',
            'branch_no'    => 'required|exists:branches,branch_no',
            
            // Next of Kin Details
            'kin_name'         => 'required|string|max:100',
            'kin_relationship' => 'required|string|max:50',
            'kin_address'      => 'required|string|max:250',
            'kin_telephone'    => 'required|string|max:20',
        ]);

        // Generate Staff No (e.g. SA001)
        $last = DB::table('staff')->orderBy('staff_no', 'desc')->first();
        $num = $last ? ((int) preg_replace('/\D/', '', $last->staff_no)) + 1 : 1;
        $staff_no = 'SA' . str_pad($num, 3, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($request, $staff_no) {
            // 1. Insert Staff
            DB::table('staff')->insert([
                'staff_no'     => $staff_no,
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'address'      => $request->address,
                'telephone_no' => $request->telephone_no,
                'sex'          => $request->sex,
                'date_of_birth'=> $request->dob,
                'date_joined'  => now()->toDateString(), // <--- FIX: Automatically sets their hire date to today!
                'nin'          => $request->nin,
                'job_title'    => $request->job_title,
                'salary'       => $request->salary,
                'branch_no'    => $request->branch_no,
                'supervisor_no'=> $request->supervisor_no ?? null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // 2. Insert Next of Kin
            DB::table('next_of_kins')->insert([
                'staff_no'     => $staff_no,
                'full_name'    => $request->kin_name,
                'relationship' => $request->kin_relationship,
                'address'      => $request->kin_address,
                'telephone_no' => $request->kin_telephone,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        });

        return redirect()->route('staff.index')->with('success', 'Staff member hired successfully.');
    }

    public function show(string $id)
    {
        $staff = DB::table('staff')->where('staff_no', $id)->first();
        abort_if(!$staff, 404);

        $kin = DB::table('next_of_kins')->where('staff_no', $id)->first();
        $branch = DB::table('branches')->where('branch_no', $staff->branch_no)->first();

        return view('staff.show', compact('staff', 'kin', 'branch'));
    }

public function edit(string $id)
    {
        // SECURITY CHECK: Managers cannot edit their own HR record.
        if (auth()->user()->hasRole('Manager') && auth()->user()->staff_no === $id) {
            return redirect()->route('staff.index')->with('error', 'Security Alert: You can only view your own HR record. Please contact a Super Admin for modifications.');
        }

        $staff = DB::table('staff')->where('staff_no', $id)->first();
        abort_if(!$staff, 404);

        $kin = DB::table('next_of_kins')->where('staff_no', $id)->first();
        $branches = DB::table('branches')->get();
        $supervisors = DB::table('staff')->whereIn('job_title', ['Manager', 'Supervisor'])->where('staff_no', '!=', $id)->get();

        return view('staff.edit', compact('staff', 'kin', 'branches', 'supervisors'));
    }

    public function update(Request $request, string $id)
    {
        // NEW SECURITY CHECK: Managers cannot promote someone else to a Manager role
        $targetStaff = DB::table('staff')->where('staff_no', $id)->first();
        if (auth()->user()->hasRole('Manager') && $request->job_title === 'Manager' && $targetStaff->job_title !== 'Manager') {
            return back()->withErrors(['job_title' => 'Security Alert: You do not have clearance to promote staff to Managers.'])->withInput();
        }

        $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'address'      => 'required|string|max:250',
            'telephone_no' => 'required|string|max:20',
            'sex'          => 'required|in:M,F',
            'dob'          => 'required|date',
            'nin'          => 'required|string|max:20|unique:staff,nin,' . $id . ',staff_no',
            'job_title'    => 'required|string|max:50',
            'salary'       => 'required|numeric|min:0',
            'branch_no'    => 'required|exists:branches,branch_no',
            
            'kin_name'         => 'required|string|max:100',
            'kin_relationship' => 'required|string|max:50',
            'kin_address'      => 'required|string|max:250',
            'kin_telephone'    => 'required|string|max:20',
        ]);

        DB::transaction(function () use ($request, $id) {
            DB::table('staff')->where('staff_no', $id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'address'       => $request->address,
                'telephone_no'  => $request->telephone_no,
                'sex'           => $request->sex,
                'date_of_birth' => $request->dob,
                'nin'           => $request->nin,
                'job_title'     => $request->job_title,
                'salary'        => $request->salary,
                'branch_no'     => $request->branch_no,
                'supervisor_no' => $request->supervisor_no ?? null,
                'updated_at'    => now(),
            ]);

            DB::table('next_of_kins')->updateOrInsert(
                ['staff_no' => $id],
                [
                    'full_name'    => $request->kin_name,
                    'relationship' => $request->kin_relationship,
                    'address'      => $request->kin_address,
                    'telephone_no' => $request->kin_telephone,
                    'updated_at'   => now(),
                ]
            );
        });
        
        return redirect()->route('staff.index')->with('success', "Staff records for {$request->first_name} updated.");
    }

    public function destroy(string $id)
    {
        // SECURITY CHECK: No user is ever allowed to delete themselves
        if (auth()->user()->staff_no === $id) {
            return redirect()->route('staff.index')->with('error', 'Action Denied: You cannot terminate your own account.');
        }

        DB::transaction(function () use ($id) {
            DB::table('next_of_kins')->where('staff_no', $id)->delete();
            DB::table('staff')->where('staff_no', $id)->delete();
        });

        return redirect()->route('staff.index')->with('success', 'Staff record removed.');
    }
}