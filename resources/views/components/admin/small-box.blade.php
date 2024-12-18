@php use App\Enums\UserRoles;use Illuminate\Support\Facades\Route; @endphp
@props([
    'entities',
])

<div class="row">
    @foreach($entities as $entity => $properties)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box h-100"
                 style="background-color: {{ $properties['color'] }}"
            >
                <div class="inner">
                    <h3>{{ $properties['title']}}</h3>

                    <p>Quantity: {{ $properties['count'] }}</p>
                </div>
                @if(Route::is('admin.index') )
                    @if($entity !== 'user' || @auth()->user()->role->value === UserRoles::SUPER_ADMIN->value)
                        <a href="{{ \route('admin.' . $entity . '.index') }}" class="small-box-footer">
                            More info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    @endforeach
</div>
