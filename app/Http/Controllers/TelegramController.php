<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    public function send(Request $request)
    {
        $cart = json_decode($request->input('cart', '[]'), true);
        $customerName = $request->input('customerName', 'N/A');
        $customerPhone = $request->input('customerPhone', 'N/A');
        $customerAddress = $request->input('customerAddress', 'N/A');

        if (empty($cart)) {
            return response()->json(['status' => 'error', 'details' => 'Cart is empty'], 400);
        }

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        // Build the Telegram message
        $message = "🛒 *New Order Received*\n\n";
        $message .= "👤 *Customer Info:*\n";
        $message .= "• Name: {$customerName}\n";
        $message .= "• Phone: {$customerPhone}\n";
        $message .= "• Address: {$customerAddress}\n\n";

        $total = 0;
        $message .= "🛍 *Order Details:*\n";

        foreach ($cart as $item) {
            $subtotal = $item['quantity'] * $item['price'];
            $total += $subtotal;
            $message .= "• {$item['itemName']} x{$item['quantity']} - $" . number_format($subtotal, 2) . "\n";
        }

        $message .= "\n💰 *Total:* $" . number_format($total, 2);

        try {
            // Send text message first
            $resMsg = Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown'
            ]);

            if ($resMsg->failed()) {
                return response()->json(['status' => 'error', 'details' => 'Failed to send Telegram message']);
            }

            // Send payment slip photo if uploaded
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $photoContents = file_get_contents($file->getRealPath());

                $resPhoto = Http::attach(
                    'photo',
                    $photoContents,
                    $file->getClientOriginalName()
                )->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                    'chat_id' => $chatId,
                    'caption' => "🧾 Payment Slip"
                ]);

                if ($resPhoto->failed()) {
                    return response()->json(['status' => 'error', 'details' => 'Failed to send payment slip']);
                }
            }

            // Send product images if available
            foreach ($cart as $item) {
                if (!empty($item['image'])) {
                    // Convert public URL to local file path
                    $imagePath = str_replace(url('/'), public_path(), $item['image']);
                    if (file_exists($imagePath)) {
                        $imageContents = file_get_contents($imagePath);

                        Http::attach(
                            'photo',
                            $imageContents,
                            basename($imagePath)
                        )->post("https://api.telegram.org/bot{$botToken}/sendPhoto", [
                            'chat_id' => $chatId,
                            'caption' => "📦 {$item['itemName']} x{$item['quantity']}"
                        ]);
                    }
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'details' => $e->getMessage()]);
        }
    }
}
