<?php
//都道府県
$rank_list = array (
        "" => "選択して下さい",
        "s" => "Sランク",
        "a" => "Aランク",
        "b" => "Bランク",
        "c" => "Cランク"
);
//都道府県
$GLOBALS['address_list'] = array (
        "01" => "北海道",
        "02" => "青森県",
        "03" => "岩手県",
        "04" => "宮城県",
        "05" => "秋田県",
        "06" => "山形県",
        "07" => "福島県",
        "08" => "茨城県",
        "09" => "栃木県",
        "10" => "群馬県",
        "11" => "埼玉県",
        "12" => "千葉県",
        "13" => "東京都",
        "14" => "神奈川県",
        "15" => "新潟県",
        "16" => "富山県",
        "17" => "石川県",
        "18" => "福井県",
        "19" => "山梨県",
        "20" => "長野県",
        "21" => "岐阜県",
        "22" => "静岡県",
        "23" => "愛知県",
        "24" => "三重県",
        "25" => "滋賀県",
        "26" => "京都府",
        "27" => "大阪府",
        "28" => "兵庫県",
        "29" => "奈良県",
        "30" => "和歌山県",
        "31" => "鳥取県",
        "32" => "島根県",
        "33" => "岡山県",
        "34" => "広島県",
        "35" => "山口県",
        "36" => "徳島県",
        "37" => "香川県",
        "38" => "愛媛県",
        "39" => "高知県",
        "40" => "福岡県",
        "41" => "佐賀県",
        "42" => "長崎県",
        "43" => "熊本県",
        "44" => "大分県",
        "45" => "宮崎県",
        "46" => "鹿児島県",
        "47" => "沖縄県"
);

$form_type_list = array (
        "matching" => "マッチング",
        "client" => "個別送客",
        "own" => "自社集客（掲載依頼など、対EC支援企業向けフォーム）",
        "kaiin" => "ECサイト会員獲得"
);
$alert_mail_list = array (
        "0" => "送信しない",
        "1" => "送信する"
);
$intro_timing_list = array (
        "direct" => "案件発生時に紹介",
        "indirect" => "ヒアリング後に紹介"
);
$intro_tab_list = array (
        "0" => "表示しない",
        "1" => "表示する"
);
$is_required_list = array (
        "off" => "任意",
        "on" => "必須"
);
$content_display_range_list = array (
        "off" => "フォームに表示しない",
        "on" => "フォームに表示する"
);
$form_item_type_list = array (
        "text" => "テキストボックス",
        "textarea" => "テキストエリア",
        "select" => "プルダウン",
        "radio" => "ラジオボタン",
        "checkbox" => "チェックボックス"
);
$is_deleted_list = array (
        "0" => "有効",
        "1" => "無効・論理削除する（論理削除済）"
);
$form_color_list = array (
        "green" => "緑",
        "blue" => "青",
        "beige" => "ベージュ",
        "purple" => "紫",
        "orange" => "オレンジ"
);
$matching_status_list = array (
        "yet" => "未対応",
        "incompatible" => "案件不可",
        "unopened" => "未公開",
        "in_progress" => "公開中",
        "done" => "公開終了",
        "close" => "終了",
        "invalid" => "無効",
        "cancel" => "中止"
);
$matching_type_list = array (
        "yet" => "未設定",
        "hot" => "HOT",
        "cool" => "COOL"
//      "other" => "その他"
);
$selection_status_list = array (
        "yet" => "未確認",
        "in_progress" => "まだ探している（追加で企業を紹介して欲しい）",
        "in_progress2" => "検討中（追加の企業紹介は不要）",
        "end" => "もう探していない"
);
$is_published_list = array (
        "0" => "準備中",
        "1" => "掲載中"
);
$inquiry_company_status_list = array (
        "yet" => "未紹介",
        "hide" => "紹介しない",
        "unopened" => "未開封",
        "conf" => "開封済み",
        "no_interest" => "手上げ拒否",
        "will_send_appo_request" => "要アポ可否質問",   //coolの場合は提案受付（未開封）
        "waiting_appo_answer" => "アポ可否回答待ち",    //coolの場合は提案受付（未回答）
        "will_send_ng_mail" => "アポNG",                //coolの場合は提案打ち切り済み
        "denied" => "アポ不成立確定",
        "will_send_ok_mail" => "要当選処理",            //coolの場合は提案受入回答済み
        "waiting_appo_datetime" => "希望アポ日程回答待ち",
        "will_send_appo_datetime" => "要アポ日程可否質問",
        "waiting_appo_datetime_answer" => "アポ日程可否待ち",
        "will_decide_appo_datetime" => "要確定処理",
        "will_adjust_appo_datetime" => "要アポ日程アナログ調整",
        "appo_datetime_decided" => "アポ確定済み",
        "closed" => "受付終了"
);
$inquiry_company_status_list_cool = array (
        "yet" => "未紹介",
        "hide" => "紹介しない",
        "unopened" => "未開封",
        "conf" => "開封済み",
        "no_interest" => "手上げ拒否",
        "will_send_appo_request" => "手上げ済み（未開封）",     //coolの場合は提案受付（未開封）
        "waiting_appo_answer" => "手上げ済み（未回答）",        //coolの場合は提案受付（未回答）
        "will_send_ng_mail" => "手上げ済み（NG）",              //coolの場合は提案打ち切り済み
//      "denied" => "アポ不成立確定",
        "will_send_ok_mail" => "手上げ済み（OK）",              //coolの場合は提案受入回答済み
//      "waiting_appo_datetime" => "希望アポ日程回答待ち",
//      "will_send_appo_datetime" => "要アポ日程可否質問",
//      "waiting_appo_datetime_answer" => "アポ日程可否待ち",
//      "will_decide_appo_datetime" => "要確定処理",
//      "will_adjust_appo_datetime" => "要アポ日程アナログ調整",
//      "appo_datetime_decided" => "アポ確定済み",
        "closed" => "受付終了"
);
$common_year_list = array (
        "2014" => "2014年"
        ,"2015" => "2015年"
        ,"2016" => "2016年"
);
$common_month_list = array (
        "01" => "01月",
        "02" => "02月",
        "03" => "03月",
        "04" => "04月",
        "05" => "05月",
        "06" => "06月",
        "07" => "07月",
        "08" => "08月",
        "09" => "09月",
        "10" => "10月",
        "11" => "11月",
        "12" => "12月"
);
$day_list = array (
        "00" => "選択して下さい",
        "01" => "01日",
        "02" => "02日",
        "03" => "03日",
        "04" => "04日",
        "05" => "05日",
        "06" => "06日",
        "07" => "07日",
        "08" => "08日",
        "09" => "09日",
        "10" => "10日",
        "11" => "11日",
        "12" => "12日",
        "13" => "13日",
        "14" => "14日",
        "15" => "15日",
        "16" => "16日",
        "17" => "17日",
        "18" => "18日",
        "19" => "19日",
        "20" => "20日",
        "21" => "21日",
        "22" => "22日",
        "23" => "23日",
        "24" => "24日",
        "25" => "25日",
        "26" => "26日",
        "27" => "27日",
        "28" => "28日",
        "29" => "29日",
        "30" => "30日",
        "31" => "31日"
);
$day_list_sp = array (
        "01" => "01日",
        "02" => "02日",
        "03" => "03日",
        "04" => "04日",
        "05" => "05日",
        "06" => "06日",
        "07" => "07日",
        "08" => "08日",
        "09" => "09日",
        "10" => "10日",
        "11" => "11日",
        "12" => "12日",
        "13" => "13日",
        "14" => "14日",
        "15" => "15日",
        "16" => "16日",
        "17" => "17日",
        "18" => "18日",
        "19" => "19日",
        "20" => "20日",
        "21" => "21日",
        "22" => "22日",
        "23" => "23日",
        "24" => "24日",
        "25" => "25日",
        "26" => "26日",
        "27" => "27日",
        "28" => "28日",
        "29" => "29日",
        "30" => "30日",
        "31" => "31日"
);
$hour_list = array (
        "08" => "08時",
        "09" => "09時",
        "10" => "10時",
        "11" => "11時",
        "12" => "12時",
        "13" => "13時",
        "14" => "14時",
        "15" => "15時",
        "16" => "16時",
        "17" => "17時",
        "18" => "18時",
        "19" => "19時",
        "20" => "20時"
);
$minute_list = array (
        "00" => "00分",
        "15" => "15分",
        "30" => "30分",
        "45" => "45分"
);
$company_type_list = array (
        "" => "未設定",
        "stock" => "株式会社",
        "limited" => "有限会社",
        "limited_liability" => "合同会社",
        "sole_proprietors" => "個人事業主",
        "other" => "その他"
);
$is_retired_list = array (
        "0" => "在籍",
        "1" => "退職"
);
$is_claimed_list = array (
        "0" => "請求対象外",
        "1" => "請求対象"
);
$condition1_list = array (
        "on" => "「紹介上限数＞手上げ数」の案件で絞り込み"
);
$condition2_list = array (
        "on" => "「手上げ数＞当選数」の案件で絞り込み"
);
$condition3_list = array (
        "on" => "「当選数＞アポ確定数」の案件で絞り込み"
);
$condition4_list = array (
        "on" => "「紹介上限数＞当選数」の案件で絞り込み"
);
$condition5_list = array (
        "on" => "「紹介上限数＞アポ確定」の案件で絞り込み"
);
$match_rate_list = array (
        "high" => "高",
        "medium" => "中"
);
$end_reason_list = array (
        "decided_own" => "当社紹介先に決めたから",
        "decided_other" => "当社紹介先以外に決めたから",
        "cancel" => "計画を延期・中止したから"
);
$line_feed_list = array (
        "1" => "1",
        "2" => "2",
        "3" => "3",
        "4" => "4",
        "5" => "5",
        "6" => "6",
        "7" => "7",
        "8" => "8",
        "9" => "9",
        "10" => "10"
);
$company_kind_list = array (
        "" => "未設定",
        "ec" => "ECサイト",
        "shien" => "EC支援",
        "both" => "両方"
);
$mikata_member_list = array (
        "no" => "非会員",
        "yes" => "会員"
);
$mail_magazine_list = array (
        "0" => "送付しない",
        "1" => "送付する"
);
$form_mail_magazine_list = array (
        "1" => "登録する",
        "0" => "登録しない"
);
$intro_type_list = array (
        "normal" => "通常（チケット分けない）",
        "fine" => "チケットを分ける"
);
$need_type_list = array (
        "shop" => "ショップ構築",
        "sales" => "売上成長",
        "cost" => "コスト削減",
        "business" => "業務改善",
        "trouble" => "トラブル解決"
);
$category_type_list = array (
        "scheme" => "仕組み",
        "operation" => "運用業務"
);
$content_type_list = array (
        "matching" => "無料紹介サービス",
        "pr" => "プレスリリース",
        "news" => "ニュース",
        "article" => "特集記事",
        "seminar" => "イベント・セミナー",
        "service" => "EC支援サービス",
        "campaign" => "期間限定キャンペーン",
        "consultation" => "無料相談室",
        "column" => "EC運営の達人コラム"
);
$client_content_type_list = array (
        "matching" => "マッチング",
        "pr" => "リリース",
        "seminar" => "イベント・セミナー",
        "service" => "指名案件獲得",
        "campaign" => "キャンペーン",
        "consultation" => "相談受付",
        "column" => "コラム"
);
$publish_status_list = array (
        "yet" => "下書き・準備中",
        "done" => "公開中"
);
$publish_type_list = array (
        "normal" => "制御なし（全て公開）",
        "limited" => "非ログイン時は一部のみ公開"
);
$is_opened_to_client_list = array (
        "0" => "表示しない",
        "1" => "表示する"
);
$is_client_used_list = array (
        "0" => "利用しない",
        "1" => "利用する"
);
$mikata_company_contract_list = array (
        "off" => "利用しない",
        "on" => "利用する"
);
$companies_tags_list = array (
        "off" => "付与しない",
        "on" => "付与する"
);
$contacts_tags_list = array (
        "off" => "付与しない",
        "on" => "付与する"
);
$contents_tags_list = array (
        "off" => "付与しない",
        "on" => "付与する"
);
$reception_list = array (
        "accepting" => "受付中",
        "finishing" => "受付終了"
);
$shopping_mall_list = array (
        "rakuten" => "楽天市場",
        "yahoo" => "Yahoo!ショッピング",
        "dena" => "DeNAショッピング",
        "amazon" => "Amazon",
        "other" => "その他"
);
$own_shop_list = array (
        "yes" => "有り",
        "no" => "無し"
);
$yearly_sales_list = array (
        "" => "未設定",
        "under_1000" => "1千万円未満",
        "under_3000" => "1千万円～3千万円未満",
        "under_5000" => "3千万円～5千万円未満",
        "under_10000" => "5千万円～1億円未満",
        "under_100000" => "1億円～10億円未満",
        "over_100000" => "10億円以上"
);
$selector_list = array (
        "user" => "問合せ企業が選定",
        "admin" => "Ryo-MAが選定サポート"
);
$possibility_list = array (
        "planning_stage" => "計画段階",
        "depend_on_proposal" => "提案次第で発注検討",
        "time_undecided" => "発注前提（時期未定）",
        "in_a_few_months" => "発注前提（時期確定）"
);
$standpoint_list = array (
        "owner" => "実施・導入を決定する立場（決裁者）",
        "leader" => "実施・導入を推進する立場（推進者）",
        "member" => "検討するために情報収集する立場（担当者）",
        "agent" => "自分のクライアントへ提案する立場（エージェント）"
);
$contact_means_list = array (
        "email" => "メール",
        "tel" => "電話",
        "fax" => "FAX",
        "other" => "その他"
);
$outsourcing_status_list = array (
        "own" => "自社対応",
        "outsourcing" => "他社業務委託",
        "new_task" => "新規業務",
        "other" => "その他"
);
$limit_list = array (
        "25" => "25件",
        "50" => "50件",
        "75" => "75件",
        "100" => "100件",
        "all" => "全て"
);
$charge_type_list = array (
        "free" => "無料",
        "pay" => "有料"
);
$check_status_list = array (
        "yet" => "未チェック",
        "done" => "チェック済"
);
$report_list = array (
        "0" => "不要",
        "1" => "要"
);
$support_count_list = array (
        "1" => "1回目",
        "2" => "2回目",
        "3" => "3回目"
);
$appoint_place_list = array (
        "ec" => "問い合わせ企業先",
        "client" => "紹介企業先",
        "other" => "その他"
);
$capital_list = array (
        "" => "未設定",
        "under_300" => "300万円未満",
        "over_300" => "300万円以上1000万円未満",
        "over_1000" => "1000万円以上5000万円未満",
        "over_5000" => "5000万円以上1億円未満",
        "over_10000" => "1億円以上10億円未満",
        "over_100000" => "10億円以上",
        "private" => "非公開"
);
$employee_number_list = array (
        "" => "未設定",
        "under_5" => "5人未満",
        "over_5" => "5人以上10人未満",
        "over_10" => "10人以上30人未満",
        "over_30" => "30以上100人未満",
        "over_100" => "100人以上500人未満",
        "over_500" => "500人以上1000人未満",
        "over_1000" => "1000人以上",
        "private" => "非公開"
);
$support_kind_list = array (
        "" => "未設定",
        "distribution_warehouse" => "物流倉庫",
        "callcenter" => "コールセンター",
        "operation_agent" => "運営代行",
        "web_site_creation" => "制作会社",
        "system_development" => "システム開発",
        "system_asp" => "システムＡＳＰ",
        "photo" => "商品撮影",
        "consulting" => "コンサルティング",
        "payment_agent" => "決済代行",
        "sales_promotion" => "集客・販促",
        "wholesaler" => "卸・商品関連",
        "other" => "その他"
);
$compare_status_list = array (
        "yet" => "未照合",
        "done" => "照合・更新済",
        "not_exist" => "対象企業無し"
);
$pre_companies_status_list = array (
        "yet" => "未照合",
        "insert" => "追加済",
        "not_insert" => "同名企業有"
);
$send_flag_list = array (
        "yes" => "発送する"
        ,"no" => "発送しない"
);
$unsent_reason_list = array (
        "" => "選択して下さい"
        ,"deny" => "拒否"
        ,"non_com" => "不送達"
        ,"intentional" => "敢えて発送しない"
);
$non_com_status_list = array (
        "off" => "正常",
        "on" => "未達"
);
$non_com_reason_list = array (
        "" => "選択して下さい",
        "address_imperfect" => "宛名不完全（番地・棟室番号漏れ）",
        "deny" => "受け取り拒否",
        "died" => "受取人死亡",
        "missing" => "転居先不明",
        "damage" => "破損",
        "post_in" => "ポストイン",
        "other" => "その他"
);
$common_sort_list = array (
        "1" => "1"
        ,"2" => "2"
        ,"3" => "3"
        ,"4" => "4"
        ,"5" => "5"
        ,"6" => "6"
        ,"7" => "7"
        ,"8" => "8"
        ,"9" => "9"
        ,"10" => "10"
);
$common_display_flag_list = array (
        "on" => "表示"
        ,"off" => "非表示"
);
$common_tax_rate_list = array (
        "0.0" => "0%"
        ,"0.05" => "5%"
        ,"0.08" => "8%"
        ,"0.1" => "10%"
);
$common_certainty_list = array (
        "fixed" => "確定"
        ,"a" => "A"
        ,"b" => "B"
        ,"c" => "C"
        ,"failure" => "失注"
        ,"cancel" => "無効"
        ,"termination" => "解約"
);
?>
