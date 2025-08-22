<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Carbon\Carbon;

class ChartCard extends Component
{

    public $title;
    public $chart;


    /**
     * Create a new component instance.
     */
    public function __construct($title, LarapexChart $chart = null)
    {
            $this->title = $title;

            $labels = [];
            $data = [];

            if ($title === 'Patients') {
                // Monthly patient registrations (last 6 months)
                $labels = $this->getLastSixMonths();
                $data = $this->getMonthlyRoleCounts('patient');
            } elseif ($title === 'Doctors') {
                $labels = $this->getLastSixMonths();
                $data = $this->getMonthlyRoleCounts('doctor');
            } elseif ($title === 'Revenue') {
                $labels = $this->getLastSixMonths();
                $data = $this->getDummyRevenue(); // replace with real revenue logic later
            } else {
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];
                $data = [0, 0, 0, 0, 0]; // fallback
            }

            $this->chart = $chart ?? (new LarapexChart)
                ->setType($title === 'Revenue' ? 'line' : 'bar')
                ->setHeight(300)
                ->setLabels($labels)
                ->setDataset([
                    [
                        'name' => $title,
                        'data' => $data,
                    ]
                ]);
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.chart-card');
    }


    private function getLastSixMonths(): array
    {
        return collect(range(0, 5))
            ->map(fn ($i) => Carbon::now()->subMonths($i)->format('M'))
            ->reverse()
            ->values()
            ->toArray();
    }

    private function getMonthlyRoleCounts(string $role): array
    {


          
        return collect(range(0, 5))
            ->map(function ($i) use ($role) {
                $month = Carbon::now()->subMonths($i);
                return User::role($role)
                    ->whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
            })
            ->reverse()
            ->values()
            ->toArray();
    }

    private function getDummyRevenue(): array
    {
       
        return [45231.89, 38900, 51200, 47800, 53000, 56000];
    }


}
