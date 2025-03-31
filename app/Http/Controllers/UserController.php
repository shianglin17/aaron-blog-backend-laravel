<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * 修改用戶的管理員權限狀態
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function updateAdminStatus(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'is_admin' => 'required|boolean'
        ]);

        $user->update([
            'is_admin' => $validated['is_admin']
        ]);

        return response()->json([
            'message' => '用戶權限更新成功',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
                'updated_at' => $user->updated_at
            ]
        ]);
    }
}
