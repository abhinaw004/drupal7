<?php
namespace Drupal\orgcode\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;

/**
 * Contribute form.
 */
class Orgcode extends FormBase 

{
	
	public function getFormId() 
	{
		return 'orgcode_form';
	}

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state,$cid = NULL) 
  {
	
	    $form['#attached']['library'][] = 'cssjs/val_master';
	   
  
  $sno=1;
  $header_table = array(
     'id'=>    t('Sno'),
      'org' => t('Organisation Name'),
        'orgcode' => t('Organisation Code'),
     
    );
    
     $query1 = \Drupal::database()->select('organisation', 'm');
      $query1->fields('m', ['org','orgcode']);
      
      $query1->orderBy('id','ASC');
        $results1 = $query1->execute()->fetchAll();
 $query = \Drupal::database()->select('organisation', 'm');
      $query->fields('m', ['org','orgcode']);
      
      $query->orderBy('id','ASC');
      $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);
      $results = $pager->execute()->fetchAll();
    $form['tit']=array(
'#prefix' => '<h2>Organisation Code</h2>', 
'#suffix' => 'Total : '.count($results1).'<br>',
   );
     
foreach($results as $data){
      
      //print the data from table

     
		   $rows[] = array(
            'id' =>$sno,
                'org' => $data->org,
                'orgcode' => $data->orgcode,
              
            );
            $sno++;
	   }
	 
    
  $form['table'] = array
  (
    '#type' => 'table',
    
    '#header' =>  $header_table,
   '#rows' => $rows,
   '#empty' => t('No Records found'),
  );
  $form['pager'] = array(
      '#type' => 'pager'
);
 
    return $form;
  }
  
      

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) 
  {
	  
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) 
  {
	 	 

	 
   
   }
  
  
 
  
}

?>
