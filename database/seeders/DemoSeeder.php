<?php

namespace Database\Seeders;

use App\Models\Entry;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;




class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Run the Dev Seeder to create some users
        $this->call(DevSeeder::class);


        // Create some users to showcase at the demo

        // Bob (Group H)
        $bob = User::create([
            'name' => "Bob",
            'email' => "bob@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // Add Bob to group G
        $bob->addToGroup("group g");

        // Add some
        $this->populateBob($bob);

        // Kevin (Group D)
        $kevin = User::create([
            'name' => "Kevin",
            'email' => "kev1@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // Add Bob to group G
        $kevin->addToGroup("group d");

        // Add some entries to for kevin
    }

    private function populateBob($bob){

        // General entries for bob
        $googleEntries = [
            [
                "My first day",
                "<h1>Dear Diary</h1> <br>Today was my first day at Google, and it was everything I imagined it to be and more! From the moment I stepped into the office, I could feel the energy and excitement in the air. My team welcomed me with open arms and wasted no time getting me up to speed on the projects I'll be working on this year. I'm already blown away by the level of talent and expertise I'm surrounded by, and I can't wait to see what the rest of the year has in store."
            ],
            [
                "Another day at Google",
                "<h1>Dear Diary</h1> <br>I can't believe how quickly time is flying by. It's been a few months since I started at Google, and I've already learned so much. I'm working on some really exciting projects with my team, and I feel like I'm constantly being challenged and pushed to my limits. The work can be intense at times, but the support and camaraderie of my colleagues make it all worth it. I'm so grateful for this opportunity and excited to see what the future holds.",
            ],
            [
                "Major update",
                "<h1>Dear Diary</h1> <br>Today was a big day at Google - we launched a major update to one of our flagship products! It's been months of hard work and late nights, but seeing the positive reception from users and the media is incredibly rewarding. I feel proud to have played a small role in such a significant milestone for the company. It's moments like this that make me appreciate even more the incredible culture and sense of purpose at Google.",
            ],
            [
                "About to finish",
                "<h1>Dear Diary</h1> <br>As my placement year at Google starts to wind down, I'm feeling a mix of emotions. On one hand, I'm sad to be leaving such an amazing company and team. On the other hand, I feel incredibly grateful for everything I've learned and accomplished this year. I've grown so much as a professional and as a person, and I know that the skills and experiences I've gained will serve me well in my future career. I'll miss Google, but I'm excited to see what the next chapter holds.",
            ],
            [
                "The end",
                "<h1>Dear Diary</h1> <br>Today is my last day at Google, and it's bittersweet. On one hand, I'm sad to say goodbye to my colleagues and the amazing company culture. On the other hand, I'm excited to take everything I've learned and apply it to the next chapter of my life. Google has been an incredible experience, and I feel incredibly lucky to have had this opportunity. I'll always be grateful for the memories, the lessons, and the friendships I've made here. Thank you, Google!"
            ],
        ];

        $counter = 0;

        // Add some general entries to for bob
        foreach($googleEntries as $entry) {
            $counter +=1;
            $date = Carbon::now()->subDays($counter)->format("d-m-Y");
            Entry::create([
                'user_id' => $bob->id,
                'template_id'=>Template::where('name', '=', 'General')->firstOrFail()->id,
                'data' => [
                    'title'=>$entry[0],
                    'content'=>$entry[1],
                    'date'=> $date
                ],
                'created_at' => $date
            ]);
        }

        // Create a new skill for bob
        $date = Carbon::now()->subDays(3)->format("d-m-Y");
        Entry::create([
            'user_id' => $bob->id,
            'template_id'=>Template::where('name', '=', 'New Skill')->firstOrFail()->id,
            'data' => [
                'title'=>'Ruby on rails',
                'what_i_learned'=>
                    "<h2>Learning Ruby on Rails at Google</h2><p>Today was an exciting day at Google! I've been given the opportunity to learn Ruby on Rails as part of my training program, and it's been a challenging but incredibly rewarding experience so far.</p><p>The first few days were overwhelming, but with the help of Google's resources and support, I quickly got up to speed on the basics of Rails. Since then, I've been working on small projects to build my skills and confidence. It's amazing to see how quickly I can create functional web applications with Rails.</p>",
                'date'=> $date
            ],
            'created_at' => $date
        ]);

        // Give bob some feedback
        $date = Carbon::now()->subDays(1)->format("d-m-Y");
        Entry::create([
            'user_id' => $bob->id,
            'template_id'=>Template::where('name', '=', 'Feedback')->firstOrFail()->id,
            'data' => [
                'title'=>'Feedback from my boss',
                'date'=> $date,
                'the_feedback'=>
                    "<h2>Feedback from my boss</h2><p>Your work at Google has been outstanding. You have consistently demonstrated a strong work ethic, a willingness to learn, and a talent for problem-solving. Your contributions have been invaluable to our team, and I have no doubt that you will go on to achieve great things in your career.</p>",
                'improvement' => '<h2>Personal Improvements Based on Feedback</h2><ol><li><p>Maintain a strong work ethic: Continue to prioritize your work and remain focused on achieving your goals.</p></li><li><p>Cultivate a willingness to learn: Keep an open mind and seek out new opportunities to expand your knowledge and skills.</p></li><li><p>Hone your problem-solving skills: Look for ways to improve your ability to identify and solve complex problems.</p></li><li><p>Focus on making valuable contributions: Take the initiative to contribute your ideas and skills to projects, and look for ways to make a positive impact on your team.</p></li><li><p>Strive for excellence in your career: Use the skills and experience you gained at Google to drive your career forward, and aim to achieve great things in the future.</p></li></ol>'
            ],
            'created_at' => $date
        ]);

        // Create some training for bob
        $date = Carbon::now()->subDays(2)->format("d-m-Y");
        Entry::create([
            'user_id' => $bob->id,
            'template_id'=>Template::where('name', '=', 'Training')->firstOrFail()->id,
            'data' => [
                'title'=>'Google cloud expert',
                'what_i_learned'=> "<h2>Learning Google Cloud</h2>
<p>Today was an exciting day at work! I had the opportunity to receive training for Google Cloud, and it was an incredible experience. I've always been interested in cloud computing, and Google Cloud is one of the most powerful and versatile platforms out there.</p>
<p>The training was intense, but I learned so much about the various tools and services offered by Google Cloud. I can already see how these tools can be used to streamline and improve our work processes, and I'm excited to start using them in my own work.</p>
<p>Overall, I feel grateful to work for a company that invests in its employees and provides opportunities for growth and development. I can't wait to see where this training takes me in my career.</p>",
                'date'=> $date
            ],
            'created_at' => $date
        ]);


    }
}
