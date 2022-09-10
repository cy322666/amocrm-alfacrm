<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\AlfaCRM\CameRequest;
use App\Http\Requests\Api\AlfaCRM\RecordRequest;
use App\Jobs\AlfaCRM\CameWithLead;
use App\Jobs\AlfaCRM\CameWithoutLead;
use App\Jobs\AlfaCRM\RecordWithLead;
use App\Jobs\AlfaCRM\RecordWithoutLead;
use App\Models\AlfaCRM\Setting;
use App\Models\AlfaCRM\Transaction;
use App\Models\Webhook;
use App\Services\AlfaCRM\Mapper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlfaCRMController extends Controller
{
    public function record(Webhook $webhook, RecordRequest $request, Transaction $transaction)
    {
        $data = $request->leads['status'][0] ?? $request->leads['add'][0];

        $transaction->setRecordData($data, $webhook);

        try {
            $setting = $webhook
                ->settings(Setting::class)
                ->firstOrFail();

            if($setting->checkStatus('record', $data['status_id'])) {

                if ($setting->work_lead == true) {

                    RecordWithLead::dispatch($setting, $webhook, $transaction, $data);
                } else
                    RecordWithoutLead::dispatch($setting, $webhook, $transaction, $data);
            }
        } catch (ModelNotFoundException $exception) {

            //TODO баг нет настроек
        } catch (\Throwable $exception) {

            $transaction->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
            $transaction->save();
        }

//            $sourceId = match ($source) {
//                'Реклама в ВК'         => Client::SOURCE_4_ID,
//                'Реклама в интернете'  => Client::SOURCE_8_ID,
//                'Поиск в интернете'    => Client::SOURCE_9_ID,
//                'Рекомендация знакомых'=> Client::SOURCE_2_ID,
//                'Живут рядом'          => Client::SOURCE_10_ID,
//                'ДубльГис'             => Client::SOURCE_11_ID,
//                'Реклама в парке им. 1 Мая' => Client::SOURCE_12_ID,
//                default => 0,
//            };
//
//            $customers = (new Customer($this->alfaApi, $branchId))
//                ->get(0, [
////                    'removed' => 1,
//                    'phone'   => $model->amo_contact_phone,
//                ]);
//
//            if ($customers['total'] > 0) {
//
//                $customerId = $customers['items'][0]['id'];
//
//            } else {
//
//                $response = (new Customer($this->alfaApi))
//                    ->create([
//                        'name' => $model->amo_children_1_name,
//                        'branch_ids' => [$model->alfa_branch_id],
//                        'is_study'   => Client::CLIENT_STUDY,
//                        'legal_type' => Client::CLIENT_TYPE_ID,
//                        'phone' => $model->amo_contact_phone,
//                        'legal_name' => $model->amo_contact_name,
//                        'email' => $model->amo_contact_email,
//                    ]);
//
//                if ($response['success'] == true) {
//
//                    $customerId = $response['model']['id'];
//                } else {
//
//                    Log::error(__METHOD__, $response);
//
////                    dd($response);
//                }
//            }
//
//            $result = (new Customer($this->alfaApi))
//                ->update($customerId ?? 0, [
//                    'name' => $model->amo_children_1_name,
//                    'lead_source_id'  => $sourceId,
//                    'study_status_id' => 1,
//                    'legal_type' => Client::CLIENT_TYPE_ID,
//                    'legal_name' => $model->amo_contact_name,
//                    'dob' => Carbon::parse($model->amo_children_1_bd)->format('d.m.Y'),
//                    //                    'balance' => ,//TODO
//                    //                    'paid_lesson_count' => ,
////                    'custom_source' => $model->amo_lead_source,
//                    'web'  => "https://podvodoinn.amocrm.ru/contacts/detail/{$contact->id}",
//                    'note' => $model->amo_lead_notes,
////                    'name' => $model->amo_children_1_name,
////                    'branch_ids' => !empty($branchIds) ? array_merge([$model->alfa_branch_id], $branchIds) : [$model->alfa_branch_id],
//                    'is_study'   => Client::CLIENT_STUDY,
//
//                    'custom_fiovtorogorebenka'    => $model->amo_children_2_name,
//                    'custom_datarozhdeniyvtorogo' => $model->amo_children_2_bd ? Carbon::parse($model->amo_children_2_bd)->format('d.m.Y') : null,
//                ]);
//
//            if ($result['success'] !== true) {
//
//                Log::error(__METHOD__, $result['errors']);
//
////                dd($response['errors']);
//            }
//
//            $model->alfa_client_id = $customerId ?? null;
//            $model->status = $model->type == 1 ? Client::STATUS_RECORDED_1 : Client::STATUS_RECORDED_2;
//            $model->save();
//
//            Notes::addOne($lead, 'Успешно отправлен в AlfaCRM');
//
//            $contact->cf('Ссылка в AlfaCRM')->setValue(
//                "https://podvodoinn.s20.online/company/{$model->alfa_branch_id}/customer/view?id={$model->alfa_client_id}"
//            );
//            $contact->save();
    }

    public function came(Webhook $webhook, CameRequest $request)
    {
        try {
            $setting = $webhook
                ->settings(Setting::class)
                ->firstOrFail();

            $transaction = $webhook->user
                ->alfaTransactions()
                ->where('alfa_branch_id', $request->branch_id)
                ->where('alfa_client_id', $request->entity_id)
                ->where('user_id', $webhook->user->id)
//                ->where('status', Mapper::RECORD)
                ->first();

            if (!$transaction) {

                $transaction = $setting->webhooks()
                    ->create([
                        'alfa_branch_id' => $request->branch_id,
                        'alfa_client_id' => $request->entity_id,
                        'user_id' => $webhook->user->id,
                    ]);
            }

            $transaction->setCameData($request->toArray(), $webhook);

//            if ($setting->work_lead == true) {

//                CameWithLead::dispatch($setting, $webhook, $transaction);
//            } else
                CameWithoutLead::dispatch($setting, $webhook, $transaction, $request->toArray());

            //TODO баг нет настроек
        } catch (\Throwable $exception) {

//            if (!empty($transaction)) {
//                $transaction->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
//                $transaction->save();
//            } else
                dd($exception->getMessage(). ' '.$exception->getLine());
        }
    }

    public function omission(Webhook $webhook)
    {

    }
}
