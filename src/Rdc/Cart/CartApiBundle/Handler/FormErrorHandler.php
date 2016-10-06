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

    public function __construct(TranslatorInterface $translator)
    {

        $this->translator = $translator;
    }

    public function serializeFormToJson(JsonSerializationVisitor $visitor, Form $form, array $type)
    {
        return $this->convertFormToArray($visitor, $form);
    }

    public function serializeFormErrorToJson(JsonSerializationVisitor $visitor, FormError $formError, array $type)
    {
        return $this->getErrorMessage($formError);
    }

    private function getErrorMessage(FormError $error)
    {
        if (null !== $error->getMessagePluralization()) {
            return $this->translator->transChoice(
                $error->getMessageTemplate(),
                $error->getMessagePluralization(),
                $error->getMessageParameters(),
                'validators'
            );
        }

        return $this->translator->trans($error->getMessageTemplate(), $error->getMessageParameters(), 'validators');
    }

    private function convertFormToArray(GenericSerializationVisitor $visitor, Form $data)
    {

        $isRoot = null === $visitor->getRoot();

        $form = new \ArrayObject();
        $errors = array();
        foreach ($data->getErrors() as $error) {
            $errors[] = $this->getErrorMessage($error);
        }

        if ($errors) {
            $form['errors'] = $errors;
        }

        $children = array();
        foreach ($data->all() as $child) {
            if ($child instanceof Form) {
                $children[$child->getName()] = $this->convertFormToArray($visitor, $child);
            }
        }

        if ($children) {
            $form['children'] = $children;
        }

        if ($isRoot) {
            $visitor->setRoot($form);
        }

        return $form;


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
