<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Default Title')</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="{{route('categories.index')}}">Категории</a></li>
            <li><a href="{{route('products.index')}}">Товары</a></li>
            <li><a href="{{route('colors.index')}}">Цвета</a></li>
            <li><a href="{{route('sizes.index')}}">Размеры</a></li>
        </ul>
    </header> 

    <main>
        @yield('content')
    </main>
    
</body>
</html>