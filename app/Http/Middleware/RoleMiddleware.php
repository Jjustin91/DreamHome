public function handle($request, Closure $next, ...$roles)
{
    $user = Auth::user();
    if (!in_array($user->job_title, $roles)) {
        return redirect()->route('unauthorized');
    }
    return $next($request);
}