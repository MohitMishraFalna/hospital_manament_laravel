<?php

namespace App\View\Components\List;

use Illuminate\View\Component;

class AllList extends Component
{
    // Every value which is recieve from controller and view. defined here as a variable and intialize using construction.
    public $columns;
    public $values;
    public $urls;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns=null, $values=null, $urls = null)
    {
        $this->columns = $columns;
        $this->values = $values;
        $this->urls = $urls;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list.all-list');
    }
}
