@component('mail::message')
# Order Confirmation

Hi {{ $user->name }},

Thank you for your order!  
Here's a summary of your purchase:

@component('mail::table')
| Product | Quantity | Price | Subtotal |
|:--------|:---------:|------:|---------:|
@foreach ($items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | ₹{{ number_format($item->price, 2) }} | ₹{{ number_format($item->price * $item->quantity, 2) }} |
@endforeach
@endcomponent

**Order Total:** ₹{{ number_format($order->total, 2) }}

Status: **{{ ucfirst($order->status) }}**

We'll notify you when your order ships.

Thanks for shopping with us!  
**{{ config('app.name') }}**

@endcomponent
