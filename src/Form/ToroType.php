<?php

namespace App\Form;

use App\Entity\Toro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Comur\ImageBundle\Form\Type\CroppableGalleryType;



class ToroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = new Toro();
        $builder
        ->add('gallery', CroppableGalleryType::class, array(
            'uploadConfig' => array(
                'uploadRoute' => 'comur_api_upload',     //optional
                'uploadDir' => $myEntity->getUploadDir(), // required - see explanation below (you can also put just a dir name relative to your public dir)
                // 'uploadUrl' => $myEntity->getUploadRootDir(),       // DEPRECATED due to security issue !!! Please use uploadDir. required - see explanation below (you can also put just a dir path)
                'webDir' => $myEntity->getWebPath(),        // required - see explanation below (you can also put just a dir path)
                'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',   //optional
                'maxFileSize' => 50, //optional
                'libraryDir' => null,             //optional
                'libraryRoute' => 'comur_api_image_library', //optional
                'showLibrary' => true,             //optional
                'saveOriginal' => 'originalImage',      //optional
                'generateFilename' => true      //optional
            ),
            'cropConfig' => array(
                'disable' => false,      //optional
                'minWidth' => 300,
                'minHeight' => 200,
                'aspectRatio' => true,         //optional
                'cropRoute' => 'comur_api_crop',   //optional
                'forceResize' => false,       //optional
                'thumbs' => array(           //optional
                  array(
                    'maxWidth' => 180,
                    'maxHeight' => 400,
                    'useAsFieldImage' => true  //optional
                  )
                )
            )
        ))
            ->add('Nombre')
            ->add('preciobase')
            ->add('info')
            ->add('videos')
            ->add('lote')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Toro::class,
        ]);
    }
}
