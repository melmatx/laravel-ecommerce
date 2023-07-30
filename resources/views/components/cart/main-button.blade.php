@props(['productId', 'isSaved', 'class' => 'flex ml-auto'])

<form
    class="{{ $class }}"
    method="POST"
    action="{{ $isSaved ? route('cart.remove', $productId) : route('cart.add', $productId)}}">
    @csrf
    @method($isSaved ? 'DELETE' : 'POST')

    @if($isSaved)
        <x-danger-button>
            Remove from Cart
        </x-danger-button>
    @else
        <x-primary-button>
            Add to Cart
        </x-primary-button>
    @endif
</form>
