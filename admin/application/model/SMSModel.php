<?php

use \Infobip\Configuration;
use \Infobip\Api\Exception;
use \Infobip\Api\SendSmsApi;
use \Infobip\ObjectSerializer;
use \Infobip\Model\SmsDestination;
use \Infobip\Model\SmsTextualMessage;
use \Infobip\Model\SmsAdvancedTextualRequest;

class SMSModel
{
	public static function enviarSMS($telefono, $texto)
    {
        $configuration = (new Configuration())
        ->setHost(Config::get('SMS_URL_BASE_PATH'))
        ->setApiKeyPrefix('Authorization', Config::get('SMS_API_KEY_PREFIX'))
        ->setApiKey('Authorization', Config::get('SMS_API_KEY'));

    	$client = new GuzzleHttp\Client();
		
		$sendSmsApi = new SendSMSApi($client, $configuration);
		$destination = (new SmsDestination())->setTo($telefono);
		$message = (new SmsTextualMessage())
			->setFrom('VIABO')
			->setText($texto)
			->setDestinations([$destination]);
		$request = (new SmsAdvancedTextualRequest())
			->setMessages([$message]);
		
		try {
			$smsResponse = $sendSmsApi->sendSmsMessage($request);
			
			$bulkId = $smsResponse->getBulkId();
    		$messageId = $smsResponse->getMessages()[0]->getMessageId();
			
			return true;
			
		} catch (Throwable $apiException) {
			echo $apiException->getCode();
			echo $apiException->getResponseHeaders();
			echo $apiException->getResponseBody();
			echo $apiException->getResponseObject();
			
			return false;
		}
    }
	
	public static function reporteEnvioSMS() 
	{
		$data = file_get_contents("php://input");
		$type = '\Infobip\Model\SmsDeliveryResult';
		$deliveryReports = ObjectSerializer::deserialize($data, $type);

		foreach ($deliveryReports->getResults() as $report) {
			echo $report->getMessageId() . " - " . $report->getStatus()->getName() . "\n";
		}
	}
}	