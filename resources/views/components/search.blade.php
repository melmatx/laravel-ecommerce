@props(['type' => 'product'])

<div class="relative w-1/2 mx-auto">
    <form method="GET" action="{{ $type === "product" ? route("search.products") : route("search.categories") }}">
        <label for="Search" class="sr-only"> Search </label>

        <input
            type="text"
            name="search"
            id="Search"
            placeholder="{{ $type === "product" ? "Search products..." : "Search categories..." }}"
            class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm"
        />

        <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
            <button type="submit" class="text-gray-600 hover:text-gray-700">
              <span class="sr-only">Search</span>

              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-4 w-4"
              >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                />
              </svg>
            </button>
        </span>
    </form>
</div>
