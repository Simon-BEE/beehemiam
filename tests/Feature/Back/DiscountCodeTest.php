<?php

namespace Tests\Feature\Back;

use App\Models\Coupon;
use App\Models\User;
use Tests\TestCase;

class DiscountCodeTest extends TestCase
{
    /** @test */
    public function an_admin_can_see_all_discounts_entries()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.discount.index'))
            ->assertSuccessful()
            ->assertViewIs('admin.discount.index')
            ->assertSee('Voir toutes les réductions');
    }

    /** @test */
    public function an_admin_can_see_create_coupon_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->get(route('admin.discount.coupons.create'))
            ->assertSuccessful()
            ->assertViewIs('admin.discount.coupons.create')
            ->assertSee('Ajouter un nouveau code promo');
    }

    /** @test */
    public function an_admin_can_create_a_coupon_code()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);

        $this->followingRedirects()->post(route('admin.discount.coupons.store'), [
            'code' => 'C0DEPROMO10',
            'amount' => '10'
        ])->assertSuccessful();

        $this->followingRedirects()->post(route('admin.discount.coupons.store'), [
            'code' => 'C0DEPROMO20',
            'amount' => '20',
            'expired_at' => now()->addMonth(),
        ])->assertSuccessful();

        $this->assertDatabaseCount('coupons', 2);
        $this->assertEquals(Coupon::find(2)->expired_at->startOfDay(), now()->addMonth()->startOfDay());
    }

    /** @test */
    public function an_admin_can_see_edit_coupon_form()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $coupon = Coupon::create(['code' => 'COUPONTEST', 'amount' => 10, 'expired_at' => null]);

        $this->get(route('admin.discount.coupons.edit', $coupon))
            ->assertSuccessful()
            ->assertViewIs('admin.discount.coupons.edit')
            ->assertSee($coupon->code);
    }

    /** @test */
    public function an_admin_can_edit_a_coupon_code()
    {
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $coupon = Coupon::create(['code' => 'COUPONTEST', 'amount' => 10, 'expired_at' => null]);

        $this->followingRedirects()
            ->patch(route('admin.discount.coupons.update', $coupon), [
                'code' => 'C0DEPROMO20',
                'amount' => '20',
                'expired_at' => now()->addMonth(),
            ])
            ->assertSuccessful();

        $this->assertEquals(20, $coupon->fresh()->amount);
        $this->assertEquals('C0DEPROMO20', $coupon->fresh()->code);
        $this->assertEquals(now()->addMonth()->startOfDay(), $coupon->fresh()->expired_at->startOfDay());
    }

    /** @test */
    public function an_admin_can_delete_a_coupon_code()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'role' => User::ADMIN_ROLE,
        ]);
        $this->signIn($user);
        $coupon = Coupon::create(['code' => 'COUPONTEST', 'amount' => 10, 'expired_at' => null]);

        $this->followingRedirects()
            ->delete(route('admin.discount.coupons.destroy', $coupon))
            ->assertSuccessful();

        $this->assertNull($coupon->fresh());
    }
}
