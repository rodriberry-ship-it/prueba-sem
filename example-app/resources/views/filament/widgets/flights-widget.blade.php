<div class="space-y-4">
    <div class="bg-black shadow rounded-xl border border-gray-600 dark:bg-gray-800 p-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Últimos vuelos</h2>
        </div>
    </div>

    <div class="grid gap-4">
        @foreach ($flights as $flight)
            <div class="bg-black shadow rounded-xl border border-gray-600 dark:bg-gray-800 p-4">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Código</p>
                        <p class="text-lg font-semibold">{{ $flight->code }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Aerolínea</p>
                        <p>{{ $flight->airline?->name }}</p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Salida</p>
                        <p>{{ $flight->origin?->name }}</p>
                        <p class="text-xs text-gray-500">Gate salida: {{ $flight->departureGate?->gate_number }}</p>
                        <p class="text-xs text-gray-500">{{ optional($flight->departure_time)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Llegada</p>
                        <p>{{ $flight->destination?->name }}</p>
                        <p class="text-xs text-gray-500">Gate llegada: {{ $flight->arrivalGate?->gate_number }}</p>
                        <p class="text-xs text-gray-500">{{ optional($flight->arrival_time)->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
