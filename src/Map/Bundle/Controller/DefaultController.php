<?php

namespace Map\Bundle\Controller;

use Map\Bundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request) {
//        Wyświetlamy index naszej aplikacji oraz formularz
        $result = $this->getDoctrine()->getRepository('MapBundle:MapData')->findAll();

        $form = $this->createFormBuilder($result)
            ->add('nazwa', TextType::class, array('label' => 'Podaj Nazwę:', 'required' => false, 'attr'=> array('class' => 'form-control', 'style' => 'margin-bottom:15px; width:95%; padding-left:1%')))
            ->add('opis', TextType::class, array('label' => 'Podaj Opis:', 'required' => false, 'attr'=> array('class' => 'form-control', 'style' => 'margin-bottom:15px; width:95%; padding-left:1%')))
            ->add('id', TextType::class, array('label' => 'Podaj ID:', 'required' => false, 'attr'=> array('class' => 'form-control', 'style' => 'margin-bottom:15px; width:95%; padding-left:1%')))
            ->add('save', SubmitType::class, array('label' => 'Szukaj', 'attr' => array('class' => 'btn btn-primary', 'style' => 'width:96%')))
            ->getForm();
        $form -> handleRequest($request);
        $datan=null;
        $datai=null;
        $datao=null;
        if($form->isSubmitted() && $form->isValid()) {
            $namen = 'nazwa';
            $namei = 'idmap';
            $nameo = 'danesm';

            $datan = $form['nazwa']->getData();
            $datai = $form['id']->getData();
            $datao = $form['opis']->getData();

            $this->pointaAction($namen,$datan);
            $this->pointaAction($namei,$datai);
            $this->pointaAction($nameo,$datao);

            return $this->render('MapBundle:Map:index.html.twig', array(
                'namen' => $namen,
                'namei' => $namei,
                'nameo' => $nameo,
                'datan' => $datan,
                'datai' => $datai,
                'datao' => $datao,
                'form' => $form->createView(),
            ));
        }
        return $this->render('MapBundle:Map:index.html.twig', array(
            'datan' => $datan,
            'datai' => $datai,
            'datao' => $datao,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/point", name="jsonn")
     */
    public function pointAction() {
//        Pobiera dane z serwera i parsuje je do JSON oraz wyświetla na pliku point.html.twig z którego później są ściągane dane przez AJAX na mapę
        $result = $this->getDoctrine()->getRepository('MapBundle:MapData')->findAll();
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
            'json' => new JsonEncoder()));
        $json = $serializer->serialize($result, 'json');
        echo $json;
        return $this->render('MapBundle:Map:point.html.twig');
    }
    /**
     * @Route("/pointa/{record}/{data}", name="jsonnn")
     */
    public function pointaAction($record, $data) {
//        Pobiera dane z serwera i parsuje do JSON
//        $record jest to zmienna która odpowiada za nazwę kolumny
//        $data jest to zmienna która odpowiada za dane w kolumnie
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT d, p
            FROM MapBundle:MapData d, MapBundle:MapPolska p
            WHERE d.'.$record.'
            LIKE :data
            AND d.idmap = p.idmap'
        )->setParameter('data', '%'.$data.'%');
        $res = $query->getResult();
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array(
            'json' => new JsonEncoder()));
        $json = $serializer->serialize($res, 'json');
        echo $json;
        return $this->render('MapBundle:Map:point.html.twig');
    }
    /**
     * @Route("/point/{idmap}", name="show")
     */
    public function detailsAction($idmap) {
//        Pobiera dane z serwera oraz wyświetla informacje na temat jednego punktu na podstawie id
        $nazwa = $this->getDoctrine()->getRepository('MapBundle:MapData')->findOneByIdmap($idmap);
        $rest = $this->getDoctrine()->getRepository('MapBundle:MapPolska')->findByIdmap($idmap);
        return $this->render('MapBundle:Map:details.html.twig', array(
            'nazwa' => $nazwa,
            'rest' => $rest,
        ));
    }
}
//php bin/console cache:clear --env=prod
