<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $division_id
 * @property int $district_id
 * @property int $upazila_id
 * @property int $union_id
 * @property string|null $name Address Name
 * @property string|null $bn_name Address Bangle Name
 * @property string|null $phone_1 Phone Number One
 * @property string|null $phone_2 Phone Number Two
 * @property int $status 0=inActive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AddressFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\Category
 *
 * @property int $id
 * @property string $name Category Name
 * @property string $type 1=Product_Category, 2=Expense_Category
 * @property int $status 0=inActive, 1=Active
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\Blog\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\CategoryPost
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost query()
 */
	class CategoryPost extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\Comment
 *
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\Blog\CommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 */
	class Comment extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\Post
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\Blog\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 */
	class Post extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\Replay
 *
 * @method static \Database\Factories\Blog\ReplayFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Replay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Replay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Replay query()
 */
	class Replay extends \Eloquent {}
}

namespace App\Models\Blog{
/**
 * App\Models\Blog\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Blog\Post[] $posts
 * @property-read int|null $posts_count
 * @method static \Database\Factories\Blog\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Brand
 *
 * @property int $id
 * @property string $name Brand Name
 * @property string|null $company Brand Company Name
 * @property string|null $company_address Brand Company Address Name
 * @property string $slug
 * @property int $status 0=inActive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BrandFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brand whereUpdatedAt($value)
 */
	class Brand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\District
 *
 * @property int $id
 * @property int $division_id
 * @property string|null $name
 * @property string|null $bn_name
 * @property string|null $lat
 * @property string|null $lon
 * @property string|null $url
 * @property int $status 1=Active; 0=inActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUrl($value)
 */
	class District extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Division
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $bn_name
 * @property string|null $url
 * @property int $status 1=Active; 0=inActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division query()
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereUrl($value)
 */
	class Division extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string|null $date Expense Created At
 * @property string|null $title Purpose of the Expense Title
 * @property string $amount Expense_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog\Category $category
 * @method static \Database\Factories\ExpenseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUserId($value)
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenseCategory
 *
 * @method static \Database\Factories\ExpenseCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseCategory query()
 */
	class ExpenseCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Good
 *
 * @property int $id
 * @property string $name Goods Name
 * @property string $slug
 * @property int $status 0=inActive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\GoodFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Good newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Good newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Good query()
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereUpdatedAt($value)
 */
	class Good extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property string|null $address
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $union_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\LocationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MarketType
 *
 * @property int $id
 * @property string $name Market Type Name
 * @property string|null $title
 * @property string $slug
 * @property int $status 0=inActive, 1=Active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Database\Factories\MarketTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType query()
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MarketType whereUpdatedAt($value)
 */
	class MarketType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Newsletter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter query()
 */
	class Newsletter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $supplier_id
 * @property string|null $date Purchase Created Date
 * @property string $order_number
 * @property string $grand_total Grand_total_price
 * @property string $total_discount Grand_total_discount
 * @property string $total_amount Grand_total_amount
 * @property string $total_pre_due Total_Previous_Due
 * @property string $quotation_image Quotation Image
 * @property int $order_status 1=Request, 2=Pending, 3=Completed
 * @property int $sale_status 0=Not_Sale, 1=Sale_Completed
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Supplier $supplier
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereQuotationImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSaleStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPreDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $product_id
 * @property string $date Purchase Items Date
 * @property int $quantity Quantity
 * @property string $unit_price
 * @property string $discount
 * @property string $sub_total
 * @property int $qty_send Send Quantity
 * @property int $qty_remain Remaining Quantity
 * @property int $item_status 1=Request, 2=Pending, 3=Completed
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\OrderItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereItemStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQtyRemain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQtySend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUserId($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OtpVerification
 *
 * @property int $id
 * @property string $phone_number
 * @property string $code
 * @property int $is_verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpVerification whereUpdatedAt($value)
 */
	class OtpVerification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int|null $plan_id
 * @property int|null $user_id
 * @property int|null $payment_log_id
 * @property string $transaction_code
 * @property string $transaction_currency
 * @property string $gateway
 * @property float $paid_amount
 * @property float $service_charge
 * @property float $store_amount
 * @property string $paid_date
 * @property string|null $payment_method
 * @property int $payment_status
 * @property int|null $system_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaidDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereServiceCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStoreAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentLog
 *
 * @property int $id
 * @property int|null $plan_id
 * @property int|null $user_id
 * @property int|null $payment_id
 * @property string $transaction_code
 * @property string $transaction_currency
 * @property string $gateway
 * @property float $paid_amount
 * @property float $service_charge
 * @property float $store_amount
 * @property string $paid_date
 * @property string|null $payment_method
 * @property int|null $system_id
 * @property string $transaction_time
 * @property string|null $success_time
 * @property string $raw_response
 * @property string $payment_step
 * @property int $payment_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaidDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePaymentStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereRawResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereServiceCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereStoreAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereSuccessTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereSystemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereTransactionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereTransactionCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereTransactionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLog whereUserId($value)
 */
	class PaymentLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $total_days
 * @property string $duration_type monthly;yearly;weekly;daily
 * @property int $trial_days
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereDurationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTotalDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereTrialDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlanSubscription
 *
 * @property int $id
 * @property int $plan_id
 * @property int $user_id
 * @property string $start_date
 * @property string $end_date
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSubscription whereUserId($value)
 */
	class PlanSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $good_id
 * @property int $category_id
 * @property int $brand_id
 * @property string $model Product Model Number
 * @property string|null $details
 * @property string $stock Product Stock Count
 * @property string $image
 * @property int $status 0=inActive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand $brand
 * @property-read \App\Models\Blog\Category $category
 * @property-read \App\Models\Good $good
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property int $user_id
 * @property int $supplier_id
 * @property string|null $date Purchase Created Date
 * @property string $invoice_number
 * @property int $purchase_status 1=Ordered, 2=Pending, 3=Received
 * @property string $grand_amount Grand_total_price
 * @property string $total_discount Grand_total_discount
 * @property string $total_amount Grand_total_amount
 * @property string $total_pay Grand_total_pay
 * @property string $total_due Grand_total_due
 * @property int $payment_status 1=unPaid, 2=partiallyPaid, 3=paid
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PurchaseItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Supplier $supplier
 * @method static \Database\Factories\PurchaseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereGrandAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase wherePurchaseStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUserId($value)
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseDue
 *
 * @property int $id
 * @property int $user_id
 * @property int $purchase_id
 * @property string|null $date Purchase Payment Created Date
 * @property string $amount Remaining Amount
 * @property string $pay Pay Amount
 * @property string $due Due Amount
 * @property int $status 1=unPaid, 2=Paid
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Purchase $purchase
 * @method static \Database\Factories\PurchaseDueFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDue whereUserId($value)
 */
	class PurchaseDue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseItem
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $product_id
 * @property int $user_id
 * @property int $trade_type 1=Buy, 2=Sell
 * @property string $quantity Quantity or Stock_In
 * @property string $unit_price Buying_Price
 * @property string $discount
 * @property string $sub_total
 * @property string $selling_price Selling_Price
 * @property string $stock_out
 * @property string $stock_available
 * @property int $stock_status 1=Stock_Available, 0=Stock_Out
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Purchase $purchase
 * @method static \Database\Factories\PurchaseItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereStockAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereStockOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereStockStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereTradeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseItem whereUserId($value)
 */
	class PurchaseItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string|null $date Created Date
 * @property string $grand_amount Grand_total_price
 * @property string $total_discount Grand_total_discount
 * @property string $total_pre_due Previous_Payment_Due
 * @property string $total_amount Grand_total_amount
 * @property string $total_pay Grand_total_pay
 * @property string $total_due Grand_total_due
 * @property int $payment_status 1=unPaid, 2=partiallyPaid, 3=paid
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Database\Factories\SaleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereGrandAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalPreDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUserId($value)
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleItem
 *
 * @property int $id
 * @property int $user_id
 * @property int $sale_id
 * @property int $order_item_id
 * @property int $product_id
 * @property string|null $date Created Date
 * @property string $qty Quantity
 * @property string $unit_price Unit_Price
 * @property string $total_price Total_Price
 * @property string $discount
 * @property string $average_discount
 * @property string $sub_total
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrderItem $order_item
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\PurchaseItem|null $purchase_item
 * @property-read \App\Models\Sale $sale
 * @method static \Database\Factories\SaleItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereAverageDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereOrderItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItem whereUserId($value)
 */
	class SaleItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleItemList
 *
 * @property int $id
 * @property int $user_id
 * @property int $sale_id
 * @property int $sale_item_id
 * @property int $purchase_item_id
 * @property string $qty Quantity
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date
 * @property-read \App\Models\PurchaseItem $purchase_item
 * @property-read \App\Models\Sale $sale
 * @property-read \App\Models\SaleItem $sale_item
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList wherePurchaseItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereSaleItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleItemList whereUserId($value)
 */
	class SaleItemList extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalePayment
 *
 * @property int $id
 * @property int $user_id
 * @property int $sale_id
 * @property string|null $date Purchase Payment Created Date
 * @property string $amount Total Amount
 * @property string $pay Pay Amount
 * @property string $due Due Amount
 * @property int $status 1=unPaid, 2=Paid
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sale $sale
 * @method static \Database\Factories\SalePaymentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereDue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment wherePay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePayment whereUserId($value)
 */
	class SalePayment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory query()
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceFeedback
 *
 * @property-read \App\Models\ServiceRequest|null $service_request
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceFeedback query()
 */
	class ServiceFeedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceList
 *
 * @property-read \App\Models\ServiceCategory|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceList query()
 */
	class ServiceList extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServicePayment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicePayment query()
 */
	class ServicePayment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceRequest
 *
 * @property-read \App\Models\ServiceFeedback|null $serviceFeedback
 * @property-read \App\Models\ServiceList|null $service_list
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRequest query()
 */
	class ServiceRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $product_id
 * @property int $type 1=Purchase, 2=Sell
 * @property string $total_unit_price
 * @property int $total_quantity
 * @property string $total_buying_price
 * @property string $total_selling_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StockFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTotalBuyingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTotalQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTotalSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTotalUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property int $market_type_id
 * @property string|null $name Supplier Name
 * @property string|null $title
 * @property string|null $phone Phone Number
 * @property string|null $address
 * @property string $slug
 * @property int $status 0=inActive, 1=Active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MarketType $market_type
 * @method static \Database\Factories\SupplierFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereMarketTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SupplierType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supplier[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Database\Factories\SupplierTypeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupplierType query()
 */
	class SupplierType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Union
 *
 * @property int $id
 * @property int $upazila_id
 * @property string|null $name
 * @property string|null $bn_name
 * @property string|null $url
 * @property int $status 1=Active; 0=inActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Union newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Union newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Union query()
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Union whereUrl($value)
 */
	class Union extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Upazila
 *
 * @property int $id
 * @property int $district_id
 * @property string|null $name
 * @property string|null $bn_name
 * @property string|null $url
 * @property int $status 1=Active; 0=inActive
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila query()
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Upazila whereUrl($value)
 */
	class Upazila extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int $address_id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone_number
 * @property int $user_type 1=Admin; 2=Workshop; 3=Customer;
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $photo
 * @property int $otp OTP Code
 * @property int $is_verified 0=unVerified; 1=Verified
 * @property int $status 1=active;0=Inactive
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceRequest[] $pendingRequests
 * @property-read int|null $pending_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceRequest[] $serviceRequests
 * @property-read int|null $service_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\Workshop|null $workShop
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property string $name Warehouses Name
 * @property string|null $title
 * @property string|null $address
 * @property string $slug
 * @property int $status 0=inActive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WarehouseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 */
	class Warehouse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Workshop
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $type 1=Workshop, 2=FuelStation, 3=Raker
 * @property string|null $description
 * @property string|null $logo
 * @property string|null $signature
 * @property string|null $cover_photo
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $license_number
 * @property int|null $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $union_id
 * @property string|null $address
 * @property string|null $zip_code
 * @property array|null $contact_no
 * @property string|null $opening_time
 * @property string|null $closing_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\District|null $districts
 * @property-read \App\Models\Division|null $divisions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceFeedback[] $serviceFeedback
 * @property-read int|null $service_feedback_count
 * @property-read \App\Models\Union|null $unions
 * @property-read \App\Models\Upazila|null $upazilas
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\WorkshopFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop newQuery()
 * @method static \Illuminate\Database\Query\Builder|Workshop onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereContactNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCoverPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workshop whereZipCode($value)
 * @method static \Illuminate\Database\Query\Builder|Workshop withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Workshop withoutTrashed()
 */
	class Workshop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WorkshopEmployee
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WorkshopEmployee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkshopEmployee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkshopEmployee query()
 */
	class WorkshopEmployee extends \Eloquent {}
}

