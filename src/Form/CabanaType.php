<?php

namespace App\Form;

use App\Entity\Cabana;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Comur\ImageBundle\Form\Type\CroppableGalleryType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class CabanaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = new Cabana();
        $builder
        ->add('desactivado')
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
                'minWidth' => 250,
                'minHeight' => 150,
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
            ->add('urlsegment',null, array(
                'label' => 'Segmento URL para la ruta web',
                'required'=>true))            
            ->add('afiche',null, array(
                'label' => 'URL Afiche'))
            ->add('condpreofertas',null, array(
                'label' => 'URL Condiciones de Preoferta'))
            ->add('catalogdescarga',null, array(
                 'label' => 'URL Catálogo'))                  
            ->add('info',null,[
                        'label'=>'PreOferta'
                    ])
                    ->add('condicionventa',null,[
                        'label'=>'Condición de Venta'
                    ])                        
                   
                    ->add('fechainicio', DateTimeType::class, [
                        'widget' => 'single_text',
                        'date_label' => 'Fecha de Inicio',
                        'placeholder' => [
                            'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                            'hour' => 'Hora', 'minute' => 'Minuto', 'second' => 'Segundo',
                        ],
                        'required'=>true
                    ])
                    ->add('fechacierre', DateTimeType::class, [
                        'widget' => 'single_text',
                        'date_label' => 'Fecha de Cierre',
                        'placeholder' => [
                            'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
                            'hour' => 'Hora', 'minute' => 'Minuto', 'second' => 'Segundo',
                        ],
                        'required'=>true
                    ])

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
            'csrf_protection' => false,
        ]);
    }
}
