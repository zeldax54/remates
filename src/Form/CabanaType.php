<?php

namespace App\Form;

use App\Entity\Cabana;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Comur\ImageBundle\Form\Type\CroppableGalleryType;
use Comur\ImageBundle\Form\Type\CollectionsType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class CabanaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = new Cabana();
        $builder
        ->add('logos', CroppableGalleryType::class, array(
            'uploadConfig' => array(
                'uploadRoute' => 'comur_api_upload',     //optional
                'uploadDir' => $myEntity->getUploadDirLogo(), // required - see explanation below (you can also put just a dir name relative to your public dir)
                // 'uploadUrl' => $myEntity->getUploadRootDir(),       // DEPRECATED due to security issue !!! Please use uploadDir. required - see explanation below (you can also put just a dir path)
                'webDir' => $myEntity->getWebPathLogo(),        // required - see explanation below (you can also put just a dir path)
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
        ->add('gallery', CroppableGalleryType::class, array(
            'uploadConfig' => array(
                'uploadRoute' => 'comur_api_upload',     
                'uploadDir' => $myEntity->getUploadDirGallery(), 
              
                'webDir' => $myEntity->getWebPathGallery(),       
                'fileExt' => '*.jpg;*.gif;*.png;*.jpeg',  
                'maxFileSize' => 50, 
                'libraryDir' => null,            
                'libraryRoute' => 'comur_api_image_library', 
                'showLibrary' => true,            
                'saveOriginal' => 'originalImage',    
                'generateFilename' => true      
            ),
            'cropConfig' => array(
                'disable' => false,      
                'minWidth' => 300,
                'minHeight' => 200,
                'aspectRatio' => true,         
                'cropRoute' => 'comur_api_crop',   
                'forceResize' => false,      
                'thumbs' => array(          
                  array(
                    'maxWidth' => 180,
                    'maxHeight' => 400,
                    'useAsFieldImage' => true  
                  )
                )
            )
        ))
            ->add('nombre')
            ->add('descripcion',CKEditorType::class,[
               'config'=>[
                   'uiColor'=>'#00a65a',
                    'toolBar'=>'full',
                     'required'=>true
               ] 
            ])
            ->add('videos')
            ->add('lotes',null, array(
                'by_reference' => false))
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cabana::class,
        ]);
    }
}
