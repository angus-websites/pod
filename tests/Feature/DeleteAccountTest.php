<?php

namespace Tests\Feature;

use App\Models\FeedbackGroup;
use App\Models\FeedbackQuestion;
use App\Models\User;
use App\Models\UserFeedback;
use Database\Seeders\core\TemplateSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_accounts_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }

    public function test_user_account_with_entries_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        // Seed some templates
        $this->seed(TemplateSeeder::class);

        $this->actingAs($user = User::factory()->hasEntries(5)->create());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());

        $this->assertEquals(0, $user->entries()->count(),);
    }

    public function test_user_account_with_feedback_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        if (config('custom.retain_feedback')){
            return $this->markTestSkipped('Feedback retention is enabled');
        }

        // Seed some templates
        $user = User::factory()->create();


        // --------------- Create some Questions -------------

        $general = FeedbackGroup::create([
            "name" => "General",
            "caption" => "General questions",
            "position" => 0,
        ]);

        // Create some questions
        $q1= FeedbackQuestion::create([
            "name" => "Q1",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
        ]);

        $q2= FeedbackQuestion::create([
            "name" => "Q2",
            "feedback_group_id" => $general->id,
            "question_type" => "text",
        ]);

        // ------ Create some responses -------------

        UserFeedback::create([
            "feedback_question_id" => $q1->id,
            "user_id" => $user->id,
            "answer" => "My answer for question 1"
        ]);


        UserFeedback::create([
            "feedback_question_id" => $q2->id,
            "user_id" => $user->id,
            "answer" => "A slightly different answer for a different question"
        ]);

        // Delete the account
        $this->actingAs($user);

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
        $this->assertEquals(0, $user->feedback()->count());
    }
}
