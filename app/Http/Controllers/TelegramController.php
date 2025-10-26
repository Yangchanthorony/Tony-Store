<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramController extends Controller
{
    public function send(Request $request)
    {
        $cart = json_decode($request->input('cart', '[]'), true);
        if (empty($cart)) {
            return response()->json(['status' => 'error', 'details' => 'Cart is empty'], 400);
        }

        // Get customer info
        $customerName = $request->input('customerName', 'N/A');
        $customerPhone = $request->input('customerPhone', 'N/A');
        $customerAddress = $request->input('customerAddress', 'N/A');

        // Prepare message
        $message = "🛍 *New Order Received!*\n";
        $message .= "====================\n\n";

        foreach ($cart as $item) {
            $subtotal = $item['quantity'] * $item['price'];
            $message .= "• *{$item['itemName']}*\n";
            $message .= "   Quantity: `{$item['quantity']}` | Price: `$" . number_format($item['price'], 2) . "`\n";
            $message .= "   Subtotal: `$" . number_format($subtotal, 2) . "`\n\n";
        }

        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['quantity'] * $item['price'], 0);
        $message .= "💰 *Total:* `$" . number_format($total, 2) . "`\n";
        $message .= "====================\n\n";

        $message .= "📝 *Customer Info:*\n";
        $message .= "• Name: `{$customerName}`\n";
        $message .= "• Phone: `{$customerPhone}`\n";
        $message .= "• Address: `{$customerAddress}`\n";

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Send formatted message (MarkdownV2)
        Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ]);

        // If image uploaded, send photo too
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('telegram_uploads', 'public');
            $photoPath = storage_path('app/public/' . $path);

            Http::attach('photo', file_get_contents($photoPath), $file->getClientOriginalName())
                ->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                    'chat_id' => $chatId,
                    'caption' => "🧾 *Payment Slip*",
                    'parse_mode' => 'Markdown'
                ]);
        }

        return response()->json(['status' => 'success']);
    }
}
