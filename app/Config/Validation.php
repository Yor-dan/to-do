<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $signIn = [
        'email' => [
            'rules'  => 'required|trim|valid_email',
            'errors' => [
                'required' => 'An email is required.',
                'valid_email' => 'Invalid email.',
            ],
        ],
        'password' => [
            'rules'  => 'required|trim',
            'errors' => [
                'required' => 'A password is required.',
            ],
        ],
    ];
    
    public $signUp = [
        'email' => [
            'rules'  => 'required|trim|valid_email|is_unique[user.email]',
            'errors' => [
                'required' => 'An email is required.',
                'valid_email' => 'Invalid email.',
                'is_unique' => 'This email is already registered',
            ],
        ],
        'password' => [
            'rules'  => 'required|trim|min_length[4]|matches[password-confirmation]',
            'errors' => [
                'required' => 'A password is required.',
                'min_length' => 'Password is too short',
                'matches' => 'Password confirmation is not match.'
            ],
        ],
        'password-confirmation' => [
            'rules'  => 'required|trim',
            'errors' => [
                'required' => 'A password confirmation is required.',
            ],
        ],
    ];
}
