<?php

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = [
            [
                'id' => 1, 
                'name' => 'Are there any hidden fees?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 2, 
                'name' => 'How do I change my credit card information, billing address, shipping address or email address?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 3, 
                'name' => 'How will you bill me?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 4, 
                'name' => 'How do I cancel?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 5, 
                'name' => 'My subscription ended. How do I renew?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 6, 
                'name' => 'I have a subscription but I need more coffee. What do I do?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '1',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 7, 
                'name' => 'How will you bill me?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '2',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 8, 
                'name' => 'How do I cancel?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '2',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 9, 
                'name' => 'My subscription ended. How do I renew?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '2',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 10, 
                'name' => 'I have a subscription but I need more coffee. What do I do?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '2',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 11, 
                'name' => 'My subscription ended. How do I renew?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '3',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 12, 
                'name' => 'I have a subscription but I need more coffee. What do I do?', 
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod volutpat facilisis. Sed tempus lorem id est tempor, ut tempus lectus porttitor. Phasellus vitae pretium sapien. Cras ac porttitor lectus. Maecenas dapibus massa nec ex tristique scelerisque. Aliquam in odio placerat, condimentum mi id, dignissim mi. Integer aliquet vehicula dictum. Suspendisse ultricies mi non vestibulum condimentum.', 
                'faq_category_id' => '3',
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ];
        
        DB::table('faq')->insert($seed);
    }
}
