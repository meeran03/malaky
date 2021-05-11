<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => ' :attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal' => ' :attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => ' :attribute يجب أن يكون بين :min و :max.',
        'file' => ' :attribute يجب أن يكون بين :min و :max kilobytes.',
        'string' => ' :attribute يجب أن يكون بين :min و :max characters.',
        'array' => ' :attribute must have between :min و :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => ' :attribute التأكيد غير متطابق.',
    'date' => ' :attribute ليس تاريخًا صالحًا.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => ' :attribute يجب أن يكون بين :min و :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ' :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'المحدد :attribute غير موجود',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ':attribute يجب أن تكون صورة.',
    'in' => 'المحدد :attribute غير صالح.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':attribute يجب أن يكون عددا صحيحا.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ' :attribute يجب أن لا يزيد عن :max.',
        'file' => ' :attribute يجب أن لا يزيد عن :max kilobytes.',
        'string' => ' :attribute يجب أن لا يزيد عن :max حروف.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => ' :attribute يجب أن يكون ملفًا من النوع: :values.',
    'mimetypes' => ' :attribute يجب أن يكون ملفًا من النوع: :values.',
    'min' => [
        'numeric' => ' :attribute يجب أن لا يقل عن :min.',
        'file' => ' :attribute يجب أن لا يقل عن :min kilobytes.',
        'string' => ' :attribute يجب أن لا يقل عن :min حروف.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attribute يجب أن يكون رقما.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => ' :attribute التنسيق غير صالح.',
    'required' => ':attribute  حقل ضروري',
    'required_if' => ' :attribute حقل ضروري عندما :other يكون :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => ' :attribute ضروري عندما :values موجود.',
    'required_with_all' => ' :attribute ضروري عندما :values موجودين.',
    'required_without' => ' :attribute ضروري عندما :values is غير موجود.',
    'required_without_all' => ' :attribute ضروري عندما none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => ' :attribute يجب أن يكون :size.',
        'file' => ' :attribute يجب أن يكون :size kilobytes.',
        'string' => ' :attribute يجب أن يكون :size رمز.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':attribute موجود سابقاً',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'phone' => [
            'regex' => 'يجب أن يكون تنسيق الهاتف مثال : 0500000000',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'title_ar'          =>'الاسم عربي',
        'title_en'          =>'الاسم انجليزي',
        'ar.title'          =>'الاسم عربي',
        'en.title'          =>'الاسم انجليزي',
        'country_id'        =>'الدولة',
        'title'             =>'العنوان',
        'city_id'           =>'المدينة',
        'nationality_id'    =>'الجنسية',
        'package_id'        =>'الباقة',
        'name'              =>'الاسم',
        'email'             =>'البريد الإلكتروني',
        'password'          =>'كلمة المرور',
        'phone'             =>'الهاتف',
        'birthday'          =>'تاريخ الميلاد',
        'gender'            =>'الجنس',
        'image'             =>'الصورة',
        'type'              =>'النوع',
        'units'             =>'عدد الوحدات',
        'from'              =>'من',
        'to'                =>'الي',
        'married'           =>'الحالة الإجتماعية',
        'has_childrens'     =>'لديك الأطفال',
        'childrens'         =>'عدد الأطفال',
        'children'          =>'الطفل',
        'children.*'          =>'الطفل',
        'address'           =>'العنوان',
        'bio'               =>'نبذة',
        'verification_code' =>'كود التفعيل',
        'percentage'        =>'النسبة المئوية',
        'file'              =>'ملف',
        'message'           =>'الرسالة',
        'receiver_id'       =>'المستلم',
        'infection'         =>'تحليل العدوي',
        'criminal'          =>'الصحيفة الجنائية',
        'cv'                =>'السيرة الذاتية',
        'identity'          =>'رقم الهوية',
        'iban'              =>'رقم الأيبان',
        'case_age'          =>'عمر الحالة',
        'images.*'          =>'الصور',
        'user_id'           =>'العضو',
        'years'             =>'السنوات',
        'months'            =>'الشهور',
        'medicine'          =>'أدوية',
        'lat'               =>'خط العرض',
        'long'              =>'خط الطول',
        'date'              =>'التاريخ',
        'status_id'         =>'الحالة',
    ],

];
