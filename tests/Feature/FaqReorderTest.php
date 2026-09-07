<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FaqReorderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_moving_order_5_to_1_shifts_1_to_4_downwards(): void
    {
        $admin = User::first() ?? User::factory()->create();

        // Setup 5 faqs
        Faq::query()->delete();
        $faqs = [];
        for ($i = 1; $i <= 5; $i++) {
            $faqs[$i] = Faq::create([
                'question' => "Pertanyaan {$i}",
                'answer' => "Jawaban {$i}",
                'display_order' => $i,
                'is_published' => true,
            ]);
        }

        // Pindahkan FAQ 5 ke urutan 1
        $response = $this->actingAs($admin)->put(route('admin.faqs.update', $faqs[5]->id), [
            'question' => $faqs[5]->question,
            'answer' => $faqs[5]->answer,
            'display_order' => 1,
        ]);

        $response->assertRedirect();

        // Verifikasi urutan
        $this->assertEquals(1, $faqs[5]->fresh()->display_order);
        $this->assertEquals(2, $faqs[1]->fresh()->display_order);
        $this->assertEquals(3, $faqs[2]->fresh()->display_order);
        $this->assertEquals(4, $faqs[3]->fresh()->display_order);
        $this->assertEquals(5, $faqs[4]->fresh()->display_order);
    }

    public function test_moving_order_1_to_5_shifts_2_to_5_upwards(): void
    {
        $admin = User::first() ?? User::factory()->create();

        Faq::query()->delete();
        $faqs = [];
        for ($i = 1; $i <= 5; $i++) {
            $faqs[$i] = Faq::create([
                'question' => "Pertanyaan {$i}",
                'answer' => "Jawaban {$i}",
                'display_order' => $i,
                'is_published' => true,
            ]);
        }

        // Pindahkan FAQ 1 ke urutan 5
        $response = $this->actingAs($admin)->put(route('admin.faqs.update', $faqs[1]->id), [
            'question' => $faqs[1]->question,
            'answer' => $faqs[1]->answer,
            'display_order' => 5,
        ]);

        $response->assertRedirect();

        // Verifikasi urutan
        $this->assertEquals(1, $faqs[2]->fresh()->display_order);
        $this->assertEquals(2, $faqs[3]->fresh()->display_order);
        $this->assertEquals(3, $faqs[4]->fresh()->display_order);
        $this->assertEquals(4, $faqs[5]->fresh()->display_order);
        $this->assertEquals(5, $faqs[1]->fresh()->display_order);
    }

    public function test_inserting_at_position_shifts_existing_items(): void
    {
        $admin = User::first() ?? User::factory()->create();

        Faq::query()->delete();
        $faq1 = Faq::create(['question' => 'Q1', 'answer' => 'A1', 'display_order' => 1, 'is_published' => true]);
        $faq2 = Faq::create(['question' => 'Q2', 'answer' => 'A2', 'display_order' => 2, 'is_published' => true]);

        // Insert at position 1
        $this->actingAs($admin)->post(route('admin.faqs.store'), [
            'question' => 'Q Baru',
            'answer' => 'A Baru',
            'display_order' => 1,
        ]);

        $this->assertEquals(2, $faq1->fresh()->display_order);
        $this->assertEquals(3, $faq2->fresh()->display_order);
    }
}
