<div class="relative overflow-x-auto">
    <table class="min-w-full table-auto md:table-fixed text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs uppercase bg-green-600 text-white sticky top-0 z-10">
            <tr>
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
