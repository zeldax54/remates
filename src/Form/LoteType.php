<?php

namespace App\Form;

use App\Entity\Lote;
use App\Entity\Toro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Comur\ImageBundle\Form\Type\CroppableGalleryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;






class LoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = new Lote();
        $builder
        ->add('desactivado')
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
            ->add('nombre')
            ->add('cabana')
            ->add('categoria')
            ->add('raza')       
            ->add('incrementominimo',IntegerType::class,[
                'label'=>'Incremento Mínimo',
                
                ] )     
            ->add('toros',null, array(
            'by_reference' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lote::class,
        ]);
    }
}
