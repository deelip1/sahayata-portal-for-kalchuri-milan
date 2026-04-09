<?php

return [
    'bootstrap_channel' => '5.3',

    'team_roles' => [
        'Patron',
        'President',
        'Vice President',
        'Secretary',
        'Treasurer',
        'IT Head',
        'District Coordinator',
        'Volunteer',
    ],

    'member_statuses' => [
        'active',
        'inactive',
        'blocked',
    ],

    'default_theme' => [
        'primary' => '#0d3b66',
        'secondary' => '#90be6d',
        'background' => '#f4f7fb',
    ],

    'ai_features' => [
        'designation_suggest' => true,
        'bio_auto_format' => true,
        'duplicate_detection' => true,
        'document_validation' => true,
        'smart_reminders' => true,
        'frontend_quick_search' => true,
        'admin_form_quality_score' => true,
    ],
];
