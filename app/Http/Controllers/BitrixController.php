<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Http\Requests\ResumeRequest;
use App\Library\CRest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BitrixController extends Controller
{
    public function addLead(LeadRequest $req)
    {
        $PARTNER_ID = 'PARTNER';
        $WEBFORM_ID = 'WEBFORM';

        try {
            $name_array = explode(' ', $req->name);
            $name = $name_array[0];
            $second_name = $name_array[1] ?? '';
        } catch (\Exception $e) {
            return [
                'message' => 'Ошибка форматирования имени',
            ];
        }

        try {
            $phone = str_replace(array('-', ' '), '', $req->phone);
        } catch (\Exception $e) {
            return [
                'message' => 'Ошибка форматирования номера',
            ];
        }
        
        try {
            $result = CRest::call(
                'crm.duplicate.findbycomm',
                [
                    'type' => 'PHONE',
                    'values' => [htmlspecialchars($phone)],
                ]
            );
            if (isset($result['result']['CONTACT'][0])) {
                $contact_id = $result['result']['CONTACT'][0];
                $source_id = $PARTNER_ID;
            }
            else {
                $result = CRest::call(
                    'crm.contact.add',
                    [
                        'fields' => [
                            'NAME' => $name,
                            'SECOND_NAME'=> $second_name,
                            'TYPE_ID' => 'CLIENT',
                            'SOURCE_ID' => "SELF",
                            'PHONE' => [ [ "VALUE" => $phone, "VALUE_TYPE" => "WORK" ] ],
                            'EMAIL' => [ [ "VALUE" => $req->email, "VALUE_TYPE" => "WORK" ] ],
                        ]
                    ]
                );
                $contact_id = $result["result"];
                $source_id = $WEBFORM_ID;
            }

            $result = CRest::call(
                "crm.lead.add",
                [
                    'fields' => [
                        'TITLE' => 'Заявка от '.$req->name, 
                        'COMMENTS' => $req->message, 
                        'CONTACT_ID' => $contact_id,
                        'SOURCE_ID' => $source_id,
                        'SOURCE_DESCRIPTION' => 'Заявка из сайта Antares'
                    ]
                ]
            );
            $result["result"];
        } catch (\Exception $e) {        
            if (isset($result['error']))
                return [
                    'message' => preg_replace('/<(?!br).*?>/si', ' ', $result['error_description']),
                ];
            return [
                'message' => 'Ошибка создания заявки',
            ];
        }

        return [
            'code' => '0',
            'message' => 'Успех',
        ];
    }

    public function addResume(ResumeRequest $req) {
        $PARTNER_ID = 'WEB';
        $WEBFORM_ID = 'WEB';

        try {
            $name = $req->name;
            $second_name = $req->secondName;
        } catch (\Exception $e) {
            return [
                'message' => 'Ошибка форматирования имени',
            ];
        }

        try {
            $phone = str_replace(array('-', ' '), '', $req->phone);
        } catch (\Exception $e) {
            return [
                'message' => 'Ошибка форматирования номера',
            ];
        }
        
        try {
            $result = CRest::call(
                'crm.duplicate.findbycomm',
                [
                    'type' => 'PHONE',
                    'values' => [htmlspecialchars($phone)],
                ]
            );
            if (isset($result['result']['CONTACT'][0])) {
                $contact_id = $result['result']['CONTACT'][0];
                $source_id = $PARTNER_ID;
            }
            else {
                $result = CRest::call(
                    'crm.contact.add',
                    [
                        'fields' => [
                            'NAME' => $name,
                            'SECOND_NAME'=> $second_name,
                            'TYPE_ID' => 'CLIENT',
                            'SOURCE_ID' => "SELF",
                            'PHONE' => [ [ "VALUE" => $phone, "VALUE_TYPE" => "WORK" ] ],
                            'EMAIL' => [ [ "VALUE" => $req->email, "VALUE_TYPE" => "WORK" ] ],
                        ]
                    ]
                );
                $contact_id = $result["result"];
                $source_id = $WEBFORM_ID;
            }

            $result = CRest::call(
                "crm.deal.add",
                [
                    'fields' => [
                        'TITLE' => 'Заполнение CRM-формы "Для кандидатов ( HR )" вакансия: '.$req->vacancy, 
                        'COMMENTS' => $req->message, 
                        'CONTACT_ID' => $contact_id,
                        'SOURCE_ID' => $source_id,
                        'CATEGORY_ID' => 9,
                        'SOURCE_DESCRIPTION' => 'Резюме из сайта Antares'
                    ]
                ]
            );
            $result["result"];
        } catch (\Exception $e) {        
            if (isset($result['error']))
                return [
                    'message' => preg_replace('/<(?!br).*?>/si', ' ', $result['error_description']),
                ];
            return [
                'message' => 'Ошибка создания заявки',
            ];
        }

        return [
            'code' => '0',
            'message' => 'Успех',
        ];
    }
}
