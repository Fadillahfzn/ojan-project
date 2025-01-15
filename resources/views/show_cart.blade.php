<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    
    @foreach ($carts as $cart)
        <img src="{{ url('storage/' . $cart->product->image) }}" method="post" height="100px">
        <p>Name: {{$cart->product->name}} </p>
        <br>
        <form action="{{ route('update_cart', $cart) }}" method="post">
            @method('patch')
            @csrf
            <input type="number" name="amount" value="{{$cart->amount}}">
            <button type="submit">Update Amont</button>
        </form>
    @endforeach

</body>
</html>