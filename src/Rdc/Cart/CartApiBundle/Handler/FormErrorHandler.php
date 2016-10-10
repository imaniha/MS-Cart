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
        $form = $errors = array();
        $form['success'] = false;
        $form['code'] = 400;

        foreach ($data->getErrors() as $error) {
            $errors['global'] = $error->getMessage();
        }

        foreach ($data->all() as $child) {
            foreach ($child->getErrors() as $error) {
                if ($error->getMessage() != '') {
                    $errors[$child->getName()] = $error->getMessage();
                }
            }

            foreach ($child->all() as $child2) {
                foreach ($child2->getErrors() as $childError) {
                    if ($childError->getMessage() != '') {
                        $errors[$child2->getName()] = $childError->getMessage();
                    }
                }
            }
        }

        if ($errors) {
            $form['errors'] = $errors;
        }

        $visitor->setRoot($form);

        return $form;
    }
}
