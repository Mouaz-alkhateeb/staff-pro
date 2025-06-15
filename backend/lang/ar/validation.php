<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | الـ following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

	'accepted' => 'الـ :attribute يجب أن يكون مقبول.',
	'accepted_if' => 'الـ :attribute يجب أن يكون مقبول عندما :other هو :value.',
	'active_url' => 'الـ :attribute رابطه غير متاح.',
	'after' => 'الـ :attribut يجب أن يكون تاريخاً بعد :date.',
	'after_or_equal' => 'الـ :attribute يجب أن يكون تاريخاً موافقاً لـ/ بعد :date.',
	'alpha' => 'الـ :attribute يجب أن يحتوي أرقاماً فقط.',
	'alpha_dash' => 'الـ :attribute يجب أن يحتوي فقط على: أحرف وأرقام و/ و _.',
	'alpha_num' => 'الـ :attribute يجب أن يحتوي فقط على أحرف وأرقام.',
	'array' => 'الـ :attribute يجب أن يكون مصفوفة.',
	'before' => 'الـ :attribute يجب أن يكون تاريخاً قبل :date.',
    'before_or_equal' => 'الـ :attribute يجب أن يكون تاريخاً موافقاً لـ/ قبل :date.',
    'between' => [
		'array' => 'الـ :attribute يجب أن يكون بين :min و :max عنصر.',
	    'file' => 'الـ :attribute يجب أن يكون بين :min و :max كيلوبايت.',
		'numeric' => 'الـ :attribute يجب أن يكون بين :min و :max.',
		'string' => 'الـ :attribute يجب أن يكون بين :min و :max حرف.',
    ],
	'boolean' => 'الـ :attribute يجب أن يكون حقل صح أم خطاً.',
	'confirmed' => 'الـ :attribute تأكيده غير متطابق.',
	'current_password' => 'كلمة السر غير صحيحة.',
	'date' => 'الـ :attribute ليس تاريخاً متاحاً.',
	'date_equals' => 'الـ :attribute يجب أن يكون تاريخاً موافقاً لـ :date.',
    'date_format' => 'الـ :attribute لا يتطابق مع التنسيق المطلوب :format.',
    'declined' => 'الـ :attribute يجب رفضه.',
    'declined_if' => 'الـ :attribute يجب رفضه عندما :other هو :value.',
    'different' => 'الـ :attribute و :other يجب أن تكون مختلفة.',
    'digits' => 'الـ :attribute يجب أن يكون :digits أرقاماً.',
    'digits_between' => 'الـ :attribute يجب أن يكون بين :min و :max رقم.',
	'dimensions' => 'الـ :attribute أبعاد صورتها غير صالحة.',
    'distinct' => 'الـ :attribute يحتوي حقله على قيمة مكررة.',
    'doesnt_end_with' => 'الـ :attribute قد لا ينتهي بواحد ما يلي: :values.',
    'doesnt_start_with' => 'الـ :attribute قد لا يبدأ بواحد مما يلي: :values.',
    'email' => 'الـ :attribute يجب أن يكون عنوان بريده الإلكتروني صالحاً.',
    'ends_with' => 'الـ :attribute يجب أن ينتهي بواحد مما يلي: :values.',
	'enum' => 'الـ :attribute المحدد غير صالح.',
    'exists' => 'الـ :attribute المحدد غير صالح.',
    'file' => 'الـ :attribute يجب أن يكون ملف.',
    'filled' => 'الـ :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
	    'array' => 'الـ :attribute يجب أن يحتوي على أكثر من :value عنصر.',
		'file' => 'الـ :attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => 'الـ :attribute يجب أن يكون أكبر من :value.',
	    'string' => 'الـ :attribute يجب أن يكون أكبر من :value حرف.',
    ],
    'gte' => [
	    'array' => 'الـ :attribute يجب أن يحتوي على :value عنصر أو أكثر.',
	    'file' => 'الـ :attribute يجب أن يكون أكبر من / موافقاً لـ :value كيلوبايت.',
	    'numeric' => 'الـ :attribute يجب أن يكون أكبر من / موافقاً لـ :value.',
	    'string' => 'الـ :attribute يجب أن يكون أكبر من / موافقاً لـ :value حرف.',
    ],
	'image' => 'الـ :attribute يجب أن يكون صورة.',
	'in' => 'الـ :attribute المحدد غير صالح.',
	'in_array' => 'الـ :attribute حقله غير موجود في :other.',
	'integer' => 'الـ :attribute يجب أن يكون عدداً صحيحاً.',
	'ip' => 'الـ :attribute يجب أن يكون عنوانه الـ IP متاحاً.',
	'ipv4' => 'الـ :attribute يجب أن يكون عنوانه الـ IPv4 متاحاً.',
    'ipv6' => 'الـ :attribute يجب أن يكون عنوانه الـ IPv6 متاحاً.',
	'json' => 'الـ :attribute يجب أن تكون سلسلته JSON صالحة.',
    'lt' => [
		'array' => 'الـ :attribute يجب أن يحتوي على أقل من :value عنصر.',
		'file' => 'الـ :attribute يجب أن يكون أقل من :value كيلوبايت.',
		'numeric' => 'الـ :attribute يجب أن يكون أقل من :value.',
	    'string' => 'الـ :attribute يجب أن يكون أقل من :value حرف.',
    ],
    'lte' => [
		'array' => 'الـ :attribute يجب ألّا يحتوي على أقل من :value عنصر.',
		'file' => 'الـ :attribute يجب أن يكون أقل من / موافقاً لـ :value كيلوبايت.',
		'numeric' => 'الـ :attribute يجب أن يكون أقل من / موافقاً لـ :value.',
		'string' => 'الـ :attribute يجب أن يكون أقل من / موافقاً لـ :value حرف.',
    ],
	'mac_address' => 'الـ :attribute يجب أن يكون عنوانه الـ MAC متاحاً.',

    'max' => [
		'array' => 'الـ :attribute يجب ألّا يحتوي على أكثر من :max عنصر.',
		'file' => 'الـ :attribute يجب ألّا يكون أكبر من :max كيلوبايت.',
		'numeric' => 'الـ :attribute يجب ألّا يكون أكبر من :max.',
		'string' => 'الـ :attribute يجب ألّا يكون أكبر من :max حرف.',
    ],
    'max_digits' => 'الـ :attribute يجب ألّا يحتوي على أكثر من :max رقم.',
	'mimes' => 'الـ :attribute يجب أن يكون ملفاً من نوع: :values.',
	'mimetypes' => 'الـ :attribute يجب أن يكون ملفاً من نوع: :values.',
    'min' => [
		'array' => 'الـ :attribute يجب أن يحتوي على الأقل على :min عنصر.',
		'file' => 'الـ :attribute يجب أن يكون على الأقل :min كيلوبايت.',
		'numeric' => 'الـ :attribute يجب أن يكون على الأقل :min.',
		'string' => 'الـ :attribute يجب أن يكون على الأقل :min حرف.',
    ],
	'min_digits' => 'الـ :attribute يجب أن يحتوي على الأقل على :min رقم.',
	'multiple_of' => 'الـ :attribute يجب أن يكون من مضاعفات :value.',
    'not_in' => 'الـ :attribute المحدد غبر متاح.',
	'not_regex' => 'الـ :attribute تنسيقه غير صالح.',
	'numeric' => 'الـ :attribute يجب أن يكون رقم.',
    'password' => [
		'letters' => 'الـ :attribute يجب أن يحتوي على حرف واحد على الأقل.',
		'mixed' => 'الـ :attribute يجب أن يحتوي على الأقل على حرف كبير واحد وحرف صغير واحد.',
		'numbers' => 'الـ :attribute يجب أن يحتوي على رقم واحد على الأقل.',
		'symbols' => 'الـ :attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'الـ :attribute المعطاة قد ظهرت في حالة تسريب بيانات. من فضلك اختيار :attribute أخرى.',
    ],
	'present' => 'الـ :attribute يجب أن يكون موجوداً.',
	'prohibited' => 'الـ :attribute حقله محظور.',
	'prohibited_if' => 'الـ :attribute يتم حظر حقله عندما :other هو :value.',
	'prohibited_unless' => 'الـ :attribute يتم حظر حقله ما لم يكن :other ضمن :values.',
	'prohibits' => 'الـ :attribute يحظر حقله :other من التواجد.',
	'regex' => 'الـ :attribute تنسيقه غير صالح.',
	'required' => 'الـ :attribute حقله مطلوب.',
	'required_array_keys' => 'الـ :attribute يجب أن يحتوي حقله على إدخالات لـ: :values.',
	'required_if' => 'الـ :attribute يكون حقله مطلوب :other هو :value.',
	'required_if_accepted' => 'الـ :attribute يكون حقله مطلوب عندما :other مقبول.',
	'required_unless' => 'الـ :attribute يكون حقله مطلوب ما لم :other هو :values.',
	'required_with' => 'الـ :attribute يكون حقله مطلوب عندما :values موجودة.',
	'required_with_all' => 'الـ :attribute يكون حقله مطلوب عندما :values موجودة.',
	'required_without' => 'الـ :attribute يكون حقله مطلوب عندما :values غير موجودة.',
	'required_without_all' => 'الـ :attribute يكون حقله مطلوب في حالة عدم وجود أي من  :values موجودة.',
	'same' => 'الـ :attribute و :other يجب أن تتطابق.',
    'size' => [
		'array' => 'الـ :attribute يجب أن يحتوي على :size عنصر.',
		'file' => 'الـ :attribute يجب أن يكون :size كيلوبايت.',
		'numeric' => 'الـ :attribute يجب أن يكون :size.',
		'string' => 'الـ :attribute يجب أن يكون :size حرف.',
    ],
	'starts_with' => 'الـ :attribute يجب أن يبدأ بواحد مما يلي: :values.',
	'string' => 'الـ :attribute يجب أن يكون سلسلة.',
	'timezone' => 'الـ :attribute يجب أن تكون منطقته الزمنية متاحة.',
	'unique' => 'الـ :attribute مستخدم مسبقاً.',
	'uploaded' => 'الـ :attribute فشل تحميله.',
    'url' => 'الـ :attribute يجب أن يكون الـ URL متاحاً.',
    'uuid' => 'الـ :attribute يجب أن يكون الـ UUID متاحاً.',

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
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | الـ following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
