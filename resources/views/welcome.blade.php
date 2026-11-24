
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripQuest - Organiza tus viajes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }
        .hero {
            background: linear-gradient(120deg, #142d4e, #28618b);
        }
    </style>
</head>
<body class="text-gray-800">

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-900">
                ✈ TripQuest
            </a>

            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800">
                        Mi panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-blue-900 font-semibold hover:text-blue-600">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-blue-900 text-white px-5 py-2 rounded-lg hover:bg-blue-800">
                        Registrarse
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="hero text-white">
            <div class="max-w-7xl mx-auto px-6 py-28 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="uppercase tracking-widest text-blue-200 font-semibold mb-4">
                        Tu próxima aventura empieza aquí
                    </p>

                    <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                        Organiza tus viajes. Disfruta cada momento.
                    </h1>

                    <p class="text-lg text-blue-100 mb-8 leading-relaxed">
                        Planifica destinos, organiza actividades, controla tus gastos
                        y prepara tu equipaje desde un único lugar.
                    </p>

                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="inline-block bg-white text-blue-900 font-bold px-8 py-4 rounded-xl hover:bg-blue-100">
                            Ir a mi panel
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                           class="inline-block bg-white text-blue-900 font-bold px-8 py-4 rounded-xl hover:bg-blue-100">
                            Crear mi cuenta
                        </a>
                    @endauth
                </div>

                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img
                        src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200"
                        alt="Paisaje de montañas"
                        class="w-full h-80 md:h-96 object-cover"
                    >
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 py-20">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-blue-950 mb-4">
                    Todo lo que necesitas para viajar
                </h2>
                <p class="text-gray-600 text-lg">
                    Mantén todos los detalles de tus aventuras organizados.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">🌍</div>
                    <h3 class="text-xl font-bold mb-3">Gestiona tus viajes</h3>
                    <p class="text-gray-600">
                        Crea viajes, añade destinos y organiza las fechas de cada etapa.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">📅</div>
                    <h3 class="text-xl font-bold mb-3">Planifica actividades</h3>
                    <p class="text-gray-600">
                        Organiza visitas, comidas y experiencias por fecha y horario.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">💰</div>
                    <h3 class="text-xl font-bold mb-3">Controla tu presupuesto</h3>
                    <p class="text-gray-600">
                        Registra gastos y consulta cuánto dinero te queda disponible.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">🧳</div>
                    <h3 class="text-xl font-bold mb-3">Prepara tu equipaje</h3>
                    <p class="text-gray-600">
                        Crea listas de objetos y marca lo que ya tienes preparado.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">📍</div>
                    <h3 class="text-xl font-bold mb-3">Guarda lugares</h3>
                    <p class="text-gray-600">
                        Guarda sitios interesantes que quieras visitar en cada destino.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="text-xl font-bold mb-3">Consulta tu progreso</h3>
                    <p class="text-gray-600">
                        Visualiza tus próximos viajes, actividades y estadísticas.
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-blue-50 py-16">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-blue-950 mb-5">
                    Tu próximo viaje merece una buena planificación
                </h2>

                <p class="text-gray-600 text-lg mb-8">
                    Empieza a organizar tu próxima aventura con TripQuest.
                </p>

                @auth
                    <a href="{{ route('trips.index') }}"
                       class="inline-block bg-blue-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-800">
                        Ver mis viajes
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="inline-block bg-blue-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-800">
                        Empezar ahora
                    </a>
                @endauth
            </div>
        </section>
    </main>

    <footer class="bg-blue-950 text-blue-100 py-7 text-center">
        <p>© {{ date('Y') }} TripQuest. Organiza tus viajes y disfruta la aventura.</p>
    </footer>

</body>
</html>
