<?php /** @noinspection PhpUnused */

namespace App\View\Components\Admin\Elements\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $route)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.elements.buttons.show-button');
    }
}
