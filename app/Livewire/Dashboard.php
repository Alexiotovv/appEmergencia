<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\sos;

class Dashboard extends Component
{
    protected function statistics()
    {
        $years = DB::table('sos')
                ->select(DB::raw('DISTINCT YEAR(fecha) as year'))
                ->orderby('year')
                ->get();
        $totalUsers=User::count();
        $activedUsers=User::where('status',1)->count();
        $totalSos=Sos::count();
        return  [
            'years'=>$years, 
            'total_users'=>$totalUsers, 
            'activos_users'=>$activedUsers,
            'total_sos'=>$totalSos
        ];
    }

    public function render()
    {
        return view('livewire.dashboard')->with( $this->statistics());
    }
}