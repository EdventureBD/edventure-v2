<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUses;
use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::query()->withCount('couponUses')->orderByDesc('created_at')->paginate(10);
        return view('admin.pages.model_exam.coupon.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|unique:coupons,name',
            'fixed' => 'required|boolean',
            'amount' => 'required',
            'validated_till' => 'required',
        ]);

        Coupon::query()->create($inputs);
        return redirect()->back()->with('status','Coupon Created Successfully');
    }

    public function checkCouponValidity(Request $request)
    {
        $inputs = $request->all();
        $coupon = Coupon::query()->where('name',$inputs['promo_code'])->first();
        $category = ExamCategory::query()->where('uuid',$inputs['category_uuid'])->first();


        if(!$coupon) {
            return response()->json([
                'status' => 'error',
                'data' => 'Invalid Coupon Code'
            ]);
        }

        if($coupon->validated_till < Carbon::now()) {
            return response()->json([
                'status' => 'error',
                'data' => 'This coupon has been expired'
            ]);
        }

        if($coupon->amount >= $category->price) {
            return response()->json([
                'status' => 'error',
                'data' => 'You can not use this coupon for this exam'
            ]);
        }

        $coupon_uses = CouponUses::query()->where('coupon_id',$coupon->id)
            ->where('user_id', auth()->user()->id)
            ->exists();
        if($coupon_uses) {
            return response()->json([
                'status' => 'error',
                'data' => 'You have already used this coupon'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $coupon->only(['fixed','amount'])
        ]);
    }

    public function destroy($couponId)
    {
        $coupon = Coupon::query()->find($couponId);
        if($coupon->has('couponUses')) {
            return redirect()->back()->with('warning','Can not delete coupon as it is already been used!');
        }

        $coupon->delete();
        return redirect()->back()->with('status','Coupon deleted successfully');

    }
}
