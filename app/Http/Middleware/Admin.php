<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Superadmin\Addons;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrFail(auth()->user()->id);

        $addons = [
            'referensi' => 'referensi',
            'sekolah' => 'sekolah',
            'fungsionaris' => 'fungsionaris',
            'pelajaran' => 'pelajaran',
            'peserta_didik' => 'peserta-didik',
            'absensi' => 'absensi',
            'e_learning' => 'e-learning',
            'daftar_nilai' => 'daftar-nilai',
            'e_rapor' => 'e-rapor',
            'pelanggaran' => 'pelanggaran',
            'e_voting' => 'e-voting',
            'kalender' => 'kalender',
            'import' => 'import',
            'perpustakaan' => 'perpustakaan',
        ];
        
        if (Auth::user()->hasRole('admin')) {
            foreach ($addons as $key => $value) {
                if(strrpos($request->path(), $key)){
                    if($user->addons[$value]){
                        return $next($request);
                    }else{
                        return redirect("admin");
                    }
                }
            }
            return $next($request);
        }

        // if (Auth::user()->hasRole('admin')) {
        //     return $next($request);
        // }

        // return redirect('home');
    }
}