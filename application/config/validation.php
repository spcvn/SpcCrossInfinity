<?php 
$config['login_validation'] = array(
	array(
		'field' => 'id',
		'label' => 'ID',
		'rules' => 'trim|required|xss_clean|max_length[12]'
		),
	array(
		'field' => 'password',
		'label' => 'PASS',
		'rules' => 'trim|required|xss_clean|max_length[50]'
		)
	);

$config['company_validation'] = array(
	array(
		'field' => 'agree',
		'label' => '利用規約',
		'rules' => 'callback_accept_terms'
	),
	array(
		'field' => 'name',
		'label' => '企業名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'post_code_1',
		'label' => '郵便番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[3]|exact_length[3]'
		),
	array(
		'field' => 'post_code_2',
		'label' => '郵便番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[4]|exact_length[4]'
		),
	array(
		'field' => 'prefecture_id',
		'label' => '都道府県',
		'rules' => 'trim|required|xss_clean|max_length[2]'
		),
	array(
		'field' => 'city',
		'label' => '市区町村',
		'rules' => 'trim|required|xss_clean|max_length[30]|callback_check_nospace'
		),
	array(
		'field' => 'street_address',
		'label' => '番地以降',
		'rules' => 'trim|required|xss_clean|max_length[100]|callback_check_nospace'
		),
	array(
		'field' => 'station',
		'label' => '最寄駅',
		'rules' => 'trim|xss_clean|max_length[100]|callback_check_nospace'
		),
	array(
		'field' => 'tel_1',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'tel_2',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'tel_3',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'mail',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email_regist|callback_check_nospace'
		),
	array(
		'field' => 'outside_url',
		'label' => 'URL',
		'rules' => 'trim|xss_clean|callback_valid_url_format|max_length[255]'
		),
	array(
		'field' => 'public_relations',
		'label' => '会社PR',
		'rules' => 'trim|xss_clean|max_length[1000]'
		),
	array(
		'field' => 'representative',
		'label' => '担当者名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'rep_tel_1',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_tel_2',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_tel_3',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_address',
		'label' => '担当者メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_nospace'
		),
	array(
		'field' => 'introduce_uid',
		'label' => '企業紹介者ID',
		'rules' => 'trim|required|xss_clean|max_length[12]|callback_check_valid_introducer_id'
		),
	array(
		'field' => 'category_id',
		'label' => 'カテゴリ',
		'rules' => 'trim|xss_clean|callback_check_required_category|numeric|max_length[50]'
		),
	array(
		'field' => 'bank_name',
		'label' => '金融機関名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'bank_branch_number',
		'label' => '店番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
		),
	array(
		'field' => 'bank_type',
		'label' => '預金種目',
		'rules' => 'trim|xss_clean'
		),
	array(
		'field' => 'bank_number',
		'label' => '口座番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
		),
	array(
		'field' => 'bank_holder',
		'label' => '口座名義人',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'password_login',
		'label' => 'ログインパスワード',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace'
		),
	array(
		'field' => 'password_reward',
		'label' => '企業情報変更パスワード',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace'
		),
	array(
		'field' => 'reward_group',
		'label' => '応援区分',
		'rules' => 'trim|required|numeric|xss_clean|max_length[2]|callback_check_valid_reward_group'
		),
	array(
		'field' => 'reward_from_data',
		'label' => '応援対象年月日From',
		'rules' => 'trim|required|xss_clean|callback_check_format_date_support|callback_compareDate|callback_check_valid_date_from|callback_check_date_from_greater_than_date_to[応援対象年月日From,応援対象年月日To,前]'
		),
	array(
		'field' => 'reward_to_data',
		'label' => '応援対象年月日To',
		'rules' => 'trim|xss_clean|callback_check_format_date_support|callback_compareDate|callback_check_date_from_greater_than_date_to[応援対象年月日To,応援対象年月日From,後]'
		),
	array(
		'field' => 'reward_from_time',
		'label' => '応援対象時間From',
		'rules' => 'trim|required|callback_time24|xss_clean|max_length[5]|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間From,応援対象時間To,前]'
		),
	array(
		'field' => 'reward_to_time',
		'label' => '応援対象時間To',
		'rules' => 'trim|xss_clean|callback_time24|max_length[5]|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間To,応援対象時間From,後]'
		),
	array(
		'field' => 'applied_lowest_price',
		'label' => '応援適用最低金額',
		'rules' => 'trim|required|xss_clean|numeric|max_length[9]'
		),
	array(
		'field' => 'discount_price',
		'label' => '購入者割引（円）',
		'rules' => 'trim|xss_clean|numeric|max_length[9]|callback_check_valid_discount|callback_check_valid_discount_input'
		),
	array(
		'field' => 'discount_rate',
		'label' => '購入者割引（％）',
		'rules' => 'trim|xss_clean|numeric|max_length[5]|callback_check_valid_discount|callback_check_valid_discount_input'
		),
	array(
		'field' => 'reward_point',
		'label' => '販売促進費(円)',
		'rules' => 'trim|xss_clean|numeric|max_length[9]|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
		),
	array(
		'field' => 'reward_point_rate',
		'label' => '販売促進費(％)',
		'rules' => 'trim|xss_clean|max_length[5]|numeric|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
		),
	array(
		'field' => 'reward_content',
		'label' => '応援内容説明',
		'rules' => 'trim|required|xss_clean|callback_check_max_length'
		)

	);

//config validation user
$config['user_validation'] = array(
	array(
        'field' => 'name',
        'label' => '会員名',
        'rules' => 'required|max_length[50]|callback_check_nospace'
    ),
    array(
        'field' => 'name_kana',
        'label' => 'ふりがな',
        'rules' => 'required|max_length[100]|callback_check_nospace'
    ),
    array(
        'field' => 'post_code_left',
        'label' => '郵便番号',
        'rules' => 'required|numeric|exact_length[3]'
    ),
    array(
        'field' => 'post_code_right',
        'label' => '郵便番号',
        'rules' => 'required|numeric|exact_length[4]'
    ),
    array(
        'field' => 'city',
        'label' => '市区町村',
        'rules' => 'required|max_length[30]|callback_check_nospace'
    ),
    array(
        'field' => 'tel_left',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[4]'
    ),
    array(
        'field' => 'tel_center',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[4]'
    ),
    array(
        'field' => 'tel_right',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[4]'
    ),
    array(
        'field' => 'mail',
        'label' => 'メールアドレス',
        'rules' => 'required|valid_email|max_length[50]|callback_email_user_unique|callback_check_nospace'
    ),
    array(
        'field' => 'password_point',
        'label' => 'ポイント使用パスワード',
        'rules' => 'required|min_length[8]|max_length[50]|callback_not_equalTo_password|callback_check_val_password|callback_not_allow_japanese_chars'
    ),
    array(
        'field' => 'password_login',
        'label' => 'ログインパスワード',
        'rules' => 'required|min_length[8]|max_length[50]|callback_not_equalTo_password|callback_check_val_password|callback_not_allow_japanese_chars'
    ),
    array(
        'field' => 'company_tel_left',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[4]|callback_check_required_company_tel'
    ),
    array(
        'field' => 'company_tel_center',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[4]|callback_check_required_company_tel'
    ),
    array(
        'field' => 'company_tel_right',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[4]|callback_check_required_company_tel'
    ),
    array(
    	'field' => 'prefecture',
        'label' => '都道府県',
        'rules' => 'required'
	),
	array(
		'field' => 'introduce_uid',
		'label' => '紹介者ID',
		'rules' => 'max_length[12]|callback_check_exist_introducer'
	),
	array(
		'field' => 'accept',
		'label' => 'accept',
		'rules' => 'callback_accept'
	),
	array(
		'field' => 'company_name',
		'label' => '法人名',
		'rules' => 'max_length[50]|callback_check_nospace'
	),
	array(
		'field' => 'company_address',
		'label' => '法人住所',
		'rules' => 'max_length[255]|callback_check_nospace'
	)
);

//config validation user
$config['edit_user_validation'] = array(
	array(
        'field' => 'name',
        'label' => '会員名',
        'rules' => 'required|max_length[50]|callback_check_nospace'
    ),
    array(
        'field' => 'name_kana',
        'label' => 'ふりがな',
        'rules' => 'required|max_length[100]|callback_check_nospace'
    ),
    array(
        'field' => 'post_code_left',
        'label' => '郵便番号',
        'rules' => 'required|numeric|exact_length[3]'
    ),
    array(
        'field' => 'post_code_right',
        'label' => '郵便番号',
        'rules' => 'required|numeric|exact_length[4]'
    ),
    array(
        'field' => 'city',
        'label' => '市区町村',
        'rules' => 'required|max_length[30]|callback_check_nospace'
    ),
    array(
        'field' => 'tel_left',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[5]'
    ),
    array(
        'field' => 'tel_center',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[5]'
    ),
    array(
        'field' => 'tel_right',
        'label' => '連絡先',
        'rules' => 'required|numeric|max_length[5]'
    ),
    array(
        'field' => 'mail',
        'label' => 'メールアドレス',
        'rules' => 'required|valid_email|max_length[50]|callback_email_user_unique|callback_check_nospace'
    ),
    array(
        'field' => 'password_point',
        'label' => 'ポイント使用パスワード',
        'rules' => 'max_length[50]|min_length[8]|callback_not_equalTo_password|callback_check_val_password|callback_not_allow_japanese_chars'
    ),
    array(
        'field' => 'password_login',
        'label' => 'ログインパスワード',
        'rules' => 'min_length[8]|max_length[50]|callback_not_equalTo_password|callback_check_val_password|callback_not_allow_japanese_chars'
    ),
    array(
        'field' => 'company_tel_left',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[5]'
    ),
    array(
        'field' => 'company_tel_center',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[5]'
    ),
    array(
        'field' => 'company_tel_right',
        'label' => '連絡先',
        'rules' => 'numeric|max_length[5]'
    ),
    array(
    	'field' => 'prefecture',
        'label' => '都道府県',
        'rules' => 'required'
	),
	array(
		'field' => 'introduce_uid',
		'label' => '紹介者ID',
		'rules' => 'max_length[12]|callback_check_exist_introducer|callback_my_own|callback_check_introduce_create_date'
	),
	array(
		'field' => 'company_name',
		'label' => '法人名',
		'rules' => 'max_length[50]|callback_check_nospace'
	),
	array(
		'field' => 'company_address',
		'label' => '法人住所',
		'rules' => 'max_length[255]|callback_check_nospace'
	)
);

$config['update_company_validation'] = array(
	array(
		'field' => 'name',
		'label' => '企業名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'post_code_1',
		'label' => '郵便番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[3]|exact_length[3]'
		),
	array(
		'field' => 'post_code_2',
		'label' => '郵便番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[4]|exact_length[4]'
		),
	array(
		'field' => 'prefecture_id',
		'label' => '都道府県',
		'rules' => 'trim|required|xss_clean|max_length[2]'
		),
	array(
		'field' => 'city',
		'label' => '市区町村',
		'rules' => 'trim|required|xss_clean|max_length[30]|callback_check_nospace'
		),
	array(
		'field' => 'street_address',
		'label' => '番地以降',
		'rules' => 'trim|required|xss_clean|max_length[100]|callback_check_nospace'
		),
	array(
		'field' => 'station',
		'label' => '最寄駅',
		'rules' => 'trim|xss_clean|max_length[100]|callback_check_nospace'
		),
	array(
		'field' => 'tel_1',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'tel_2',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'tel_3',
		'label' => '企業連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'outside_url',
		'label' => 'URL',
		'rules' => 'trim|xss_clean|callback_valid_url_format|max_length[255]'
		),
	array(
		'field' => 'public_relations',
		'label' => '会社PR',
		'rules' => 'trim|xss_clean|max_length[1000]'
		),
	array(
		'field' => 'representative',
		'label' => '担当者名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'rep_tel_1',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_tel_2',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_tel_3',
		'label' => '担当者連絡先',
		'rules' => 'trim|required|xss_clean|numeric|callback_check_max_length_tel'
		),
	array(
		'field' => 'rep_address',
		'label' => '担当者メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_nospace'
		),
	array(
		'field' => 'introduce_uid',
		'label' => '企業紹介者ID',
		'rules' => 'trim|required|xss_clean|max_length[12]|callback_check_valid_introducer_id'
		),
	array(
		'field' => 'category_id',
		'label' => 'カテゴリ',
		'rules' => 'trim|xss_clean|callback_check_required_category|numeric|max_length[50]'
		),
	array(
		'field' => 'bank_name',
		'label' => '金融機関名',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		),
	array(
		'field' => 'bank_branch_number',
		'label' => '店番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
		),
	array(
		'field' => 'bank_type',
		'label' => '預金種目',
		'rules' => 'trim|xss_clean'
		),
	array(
		'field' => 'bank_number',
		'label' => '口座番号',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
		),
	array(
		'field' => 'bank_holder',
		'label' => '口座名義人',
		'rules' => 'trim|required|xss_clean|max_length[50]|callback_check_nospace'
		)
);

$config['update_support_empty'] = array(
	array(
		'field' => 'password_login',
		'label' => 'ログインパスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_reward'
		),
	array(
		'field' => 'password_reward',
		'label' => '企業情報変更パスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_login'
		),
	array(
		'field' => 'mail',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email_update|callback_check_nospace'
		),
);

$config['update_support_validation'] = array(
	array(
		'field' => 'password_login',
		'label' => 'ログインパスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_reward'
		),
	array(
		'field' => 'password_reward',
		'label' => '企業情報変更パスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_login'
		),
	array(
		'field' => 'mail',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email_update|callback_check_nospace'
		),
	array(
		'field' => 'reward_group',
		'label' => '応援区分',
		'rules' => 'trim|required|numeric|xss_clean|max_length[2]|callback_check_valid_reward_group'
	),
	array(
		'field' => 'reward_from_data',
		'label' => '応援対象年月日From',
		'rules' => 'trim|required|xss_clean|callback_check_format_date_support'
	),
	array(
		'field' => 'reward_to_data',
		'label' => '応援対象年月日To',
		'rules' => 'trim|xss_clean|callback_checkIssetTo|callback_compareDate|callback_check_format_date_support'
	),
	array(
		'field' => 'reward_from_time',
		'label' => '応援対象時間From',
		'rules' => 'trim|required|xss_clean|callback_time24|max_length[5]|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間From,応援対象時間To,前]'
	),
	array(
		'field' => 'reward_to_time',
		'label' => '応援対象時間To',
		'rules' => 'trim|xss_clean|max_length[5]|callback_time24|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間To,応援対象時間From,後]'
	),
	array(
		'field' => 'applied_lowest_price',
		'label' => '応援適用最低金額',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
	),
	array(
		'field' => 'discount_price',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_discount|callback_check_valid_discount_input'
	),
	array(
		'field' => 'discount_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[5]|callback_check_valid_discount|callback_check_valid_discount_input'
	),
	array(
		'field' => 'reward_point',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
	),
	array(
		'field' => 'reward_point_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|max_length[5]|numeric|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
	),
	array(
		'field' => 'reward_content',
		'label' => '応援内容説明',
		'rules' => 'trim|required|xss_clean|callback_check_max_length|callback_check_nospace'
	),
);

$config['add_support_validation'] = array(
	array(
		'field' => 'password_login',
		'label' => 'ログインパスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_reward'
		),
	array(
		'field' => 'password_reward',
		'label' => '企業情報変更パスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_login'
		),
	array(
		'field' => 'mail',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email_update|callback_check_nospace'
		),
	array(
		'field' => 'tmp_reward_group',
		'label' => '応援区分',
		'rules' => 'trim|required|numeric|xss_clean|max_length[2]|callback_check_valid_reward_group_add'
	),
	array(
		'field' => 'tmp_reward_from_data',
		'label' => '応援対象年月日From',
		'rules' => 'trim|required|xss_clean|callback_compareDate_greater|callback_check_format_date_support|callback_checkGreaterThanTen'
	),
	array(
		'field' => 'tmp_reward_to_data',
		'label' => '応援対象年月日To',
		'rules' => 'trim|xss_clean|callback_checkIssetToAdd|callback_compareDate_add|callback_check_format_date_support'
	),
	array(
		'field' => 'tmp_reward_from_time',
		'label' => '応援対象時間From',
		'rules' => 'trim|required|xss_clean|max_length[5]|callback_time24|callback_check_format_time_support|callback_check_valid_time_support_add'
	),
	array(
		'field' => 'tmp_reward_to_time',
		'label' => '応援対象時間To',
		'rules' => 'trim|xss_clean|max_length[5]|callback_time24|callback_check_format_time_support|callback_check_valid_time_support_add'
	),
	array(
		'field' => 'tmp_applied_lowest_price',
		'label' => '応援適用最低金額',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
	),
	array(
		'field' => 'tmp_discount_price',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_discount_add|callback_check_valid_discount_input_add'
	),
	array(
		'field' => 'tmp_discount_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[5]|callback_check_valid_discount_add|callback_check_valid_discount_input_add'
	),
	array(
		'field' => 'tmp_reward_point',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_reward_point_add|callback_check_valid_reward_point_input_add'
	),
	array(
		'field' => 'tmp_reward_point_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|max_length[5]|numeric|callback_check_valid_reward_point_add|callback_check_valid_reward_point_input_add'
	),
	array(
		'field' => 'tmp_reward_content',
		'label' => '応援内容説明',
		'rules' => 'trim|required|xss_clean|callback_check_max_length|callback_check_nospace'
	),
);

$config['all_support_validation'] = array(
	array(
		'field' => 'password_login',
		'label' => 'ログインパスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_reward'
		),
	array(
		'field' => 'password_reward',
		'label' => '企業情報変更パスワード',
		'rules' => 'trim|xss_clean|min_length[8]|max_length[50]|callback_check_format_password|callback_not_allow_japanese_chars|callback_check_password_same|callback_check_nospace|callback_check_isset_password_login'
		),
	array(
		'field' => 'mail',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email_update|callback_check_nospace'
		),
	array(
		'field' => 'reward_group',
		'label' => '応援区分',
		'rules' => 'trim|required|numeric|xss_clean|max_length[2]|callback_check_valid_reward_group_all'
	),
	array(
		'field' => 'reward_from_data',
		'label' => '応援対象年月日From',
		'rules' => 'trim|required|xss_clean|callback_check_format_date_support'
	),
	array(
		'field' => 'reward_to_data',
		'label' => '応援対象年月日To',
		'rules' => 'trim|xss_clean|callback_checkIssetTo|callback_compareDate|callback_check_format_date_support'
	),
	array(
		'field' => 'reward_from_time',
		'label' => '応援対象時間From',
		'rules' => 'trim|required|xss_clean|max_length[5]|callback_time24|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間From,応援対象時間To,前]'
	),
	array(
		'field' => 'reward_to_time',
		'label' => '応援対象時間To',
		'rules' => 'trim|xss_clean|max_length[5]|callback_time24|callback_check_format_time_support|callback_check_valid_time_support[応援対象時間To,応援対象時間From,後]'
	),
	array(
		'field' => 'applied_lowest_price',
		'label' => '応援適用最低金額',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
	),
	array(
		'field' => 'discount_price',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_discount|callback_check_valid_discount_input'
	),
	array(
		'field' => 'discount_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[5]|callback_check_valid_discount|callback_check_valid_discount_input'
	),
	array(
		'field' => 'reward_point',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
	),
	array(
		'field' => 'reward_point_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|max_length[5]|numeric|callback_check_valid_reward_point|callback_check_valid_reward_point_input'
	),
	array(
		'field' => 'reward_content',
		'label' => '応援内容説明',
		'rules' => 'trim|required|xss_clean|callback_check_max_length|callback_check_nospace'
	),
	array(
		'field' => 'tmp_reward_group',
		'label' => '応援区分',
		'rules' => 'trim|required|numeric|xss_clean|max_length[2]'
	),
	array(
		'field' => 'tmp_reward_from_data',
		'label' => '応援対象年月日From',
		'rules' => 'trim|required|xss_clean|callback_compareDate_greater|callback_check_format_date_support|callback_checkGreaterThanTen'
	),
	array(
		'field' => 'tmp_reward_to_data',
		'label' => '応援対象年月日To',
		'rules' => 'trim|xss_clean|callback_checkIssetToAdd|callback_compareDate_add|callback_check_format_date_support'
	),
	array(
		'field' => 'tmp_reward_from_time',
		'label' => '応援対象時間From',
		'rules' => 'trim|required|xss_clean|max_length[5]|callback_check_format_time_support|callback_check_valid_time_support_add'
	),
	array(
		'field' => 'tmp_reward_to_time',
		'label' => '応援対象時間To',
		'rules' => 'trim|xss_clean|max_length[5]|callback_check_format_time_support|callback_check_valid_time_support_add'
	),
	array(
		'field' => 'tmp_applied_lowest_price',
		'label' => '応援適用最低金額',
		'rules' => 'trim|required|xss_clean|numeric|max_length[20]'
	),
	array(
		'field' => 'tmp_discount_price',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_discount_add|callback_check_valid_discount_input_add'
	),
	array(
		'field' => 'tmp_discount_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[5]|callback_check_valid_discount_add|callback_check_valid_discount_input_add'
	),
	array(
		'field' => 'tmp_reward_point',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|numeric|max_length[20]|callback_check_valid_reward_point_add|callback_check_valid_reward_point_input_add'
	),
	array(
		'field' => 'tmp_reward_point_rate',
		'label' => '応援区分',
		'rules' => 'trim|xss_clean|max_length[5]|numeric|callback_check_valid_reward_point_add|callback_check_valid_reward_point_input_add'
	),
	array(
		'field' => 'tmp_reward_content',
		'label' => '応援内容説明',
		'rules' => 'trim|required|xss_clean|callback_check_max_length|callback_check_nospace'
	),
);

$config['regist_support_service_validation'] = array(
	array(
		'field' => 'introduce_uid',
		'label' => '会員IDまたは紹介者会員ID',
		'rules' => 'trim|xss_clean|required|max_length[12]|callback_check_exist_user'
	),
	array(
		'field' => 'buy_price',
		'label' => '購入金額',
		'rules' => 'trim|xss_clean|required|numeric|max_length[9]|callback_check_valid_buy_price|callback_check_purchase_price_minimum'
	),
	array(
		'field' => 'point',
		'label' => '購入金額',
		'rules' => 'trim|xss_clean|numeric|max_length[9]|callback_check_valid_point|callback_check_valid_user_point|callback_check_point_greater_buy_price'
	),
	array(
		'field' => 'password_point',
		'label' => 'ポイントパスワード',
		'rules' => 'trim|xss_clean|max_length[20]|callback_check_required_password_point|callback_check_valid_password_point'
	)
);
$config['reset_password'] = array(
	array(
		'field' => 'email',
		'label' => 'メールアドレス',
		'rules' => 'trim|required|xss_clean|valid_email|max_length[255]|callback_check_exist_email'
	)
);

$config['new_password'] = array(
	array(
		'field' => 'password',
		'label' => '新しいログインPASS',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_same|callback_check_val_password|callback_not_allow_japanese_chars|callback_check_password_same_two'
		),
	array(
		'field' => 'confirm_password',
		'label' => 'ログインPASSの再入力',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_same|callback_check_val_password|callback_not_allow_japanese_chars'
		),
	array(
		'field' => 'password_reward',
		'label' => '新しい企業情報変更PASS',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_reward_same|callback_check_val_password|callback_not_allow_japanese_chars|callback_check_password_same_two'
		),
	array(
		'field' => 'confirm_password_reward',
		'label' => '企業情報変更PASSの再入力',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_reward_same|callback_check_val_password|callback_not_allow_japanese_chars'
		)
);

$config['new_password_user'] = array(
	array(
		'field' => 'password',
		'label' => '新しいログインPASS',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_same|callback_check_val_password|callback_not_allow_japanese_chars'
		),
	array(
		'field' => 'confirm_password',
		'label' => 'ログインPASSの再入力',
		'rules' => 'trim|required|xss_clean|min_length[8]|max_length[50]|callback_check_password_same|callback_check_val_password|callback_not_allow_japanese_chars'
		)
);

$config['password_confirm_validation'] = array(
	array(
		'field' => 'password_confirm',
		'label' => '',
		'rules' => 'xss_clean|callback_check_password_confirm|required'
		)
);