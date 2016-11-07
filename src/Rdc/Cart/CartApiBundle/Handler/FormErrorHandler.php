<?php

namespace Rdc\Cart\CartApiBundle\Handler;

use JMS\Serializer\YamlSerializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\GenericSerializationVisitor;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Translation\TranslatorInterface;
use JMS\Serializer\XmlSerializationVisitor;
use JMS\Serializer\Handler\FormErrorHandler as JMSFormErrorHandler;

class FormErrorHandler extends JMSFormErrorHandler
{

    public function serializeFormToJson(JsonSerializationVisitor $visitor, Form $form, array $type)
    {
        return $this->convertFormToArray($visitor, $form);
    }

    private function convertFormToArray(GenericSerializationVisitor $visitor, Form $data)
    {
        $form = $errors = $globals = [];
        $form['success'] = false;
        $form['code'] = 400;
        $form['errors'] = [];

        //get global error
        foreach ($data->getErrors() as $error) {
            $global[] = $error->getMessage();
        }

        $this->getErrors($data, $errors);

        if ($globals) {
            $form['errors']['global'] = $globals;
        }
        if ($errors) {
            $form['errors']['fields'] = $errors;
        }

        $visitor->setRoot($form);

        return $form;
    }

    protected function getErrors($data, &$errors)
    {

        foreach ($data->all() as  $child) {
            foreach ($child->getErrors() as $error) {
                if ($error->getMessage() != '') {
                    $errors[$child->getName()] = $error->getMessage();
                }
            }

            if ($child->all()) {
                $this->getErrors($child, $errors);
            }
        }

        return $errors;
    }
}
