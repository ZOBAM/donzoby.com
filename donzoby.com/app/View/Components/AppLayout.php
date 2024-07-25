<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $posts,
        public array $listedSubjects,
        public string $title = '',
        public string $description = '',
        public string $pageImage = '',
        public string $customStyle = '',
    ) {
        $app_name = config('app.name', 'Laravel');
        $this->title = $this->title ? "$this->title - $app_name" : $app_name;
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
