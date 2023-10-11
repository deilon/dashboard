<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PageBreadcrumb extends Component
{
    public $pageTitle;

    /**
     * Create a new component instance.
     */
    public function __construct($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-breadcrumb');
    }
}
