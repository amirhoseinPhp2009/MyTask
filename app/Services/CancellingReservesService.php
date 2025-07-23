<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Services;

use App\DTO\ReserveCancellingDTO;
use App\Enums\StatusCode;
use App\Events\SendMessageByTelegramBotEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CancellingReservesService
{
    public function getReservesByCountryId(int $countryId): array
    {
        DB::table('reserves')->select('reserves.id', 'reserves.user_id', 'reserves.status', 'reserves.cancelled_at', 'reserves.created_at')->
        join('users', 'reserves.user_id', '=', 'users.id')->
        where('users.country_id', $countryId)->where('reserves.cancelled_at', NULL)->
        orderBy('reserves.created_at', 'desc');
    }

    public function reservesCancelling(array $reserves): JSONResponse
    {
        if (count($reserves) > 1) {
            foreach ($reserves as $reserve) {

                $cancellingReserveData = ReserveCancellingDTO::createCancellingReserveData($reserve);
                $reserveData = $cancellingReserveData['reserveData'];
                $messageDataToUser = $cancellingReserveData['messageDataToUser'];
                $message = __('messages.cancellingReserveMessageToUsers', $messageDataToUser);

                SendMessageByTelegramBotEvent::dispatch($message);

                $response = $reserve->update($reserveData);

                return response()->json($response, StatusCode::OK->value);
            }
        }
    }
}

