<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Email_temp;
use Illuminate\Support\Facades\Mail;

class EmailController extends AdminController
{
     /**
     * Show List.
     *
     * @param  array  $data
     * @return void
     */
    public function index()
    {
        $data = Email_temp::all();

        return View('admin.emails.email_index', compact('data'));
    }

     /**
     * Create record
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function postUpdate(Request $request,$id)
    {
        $this->validate($request,
              [
              'name' => 'required',
              'subject' => 'required',
              'content' => 'required',
              'description' => 'required',
          ]);
         
        $email_temp = Email_temp::find($id);

        $replaced = str_replace('{{%','%#',$request->content);
        $content = str_replace('%}}','#%',$replaced);

        $sub_replaced = str_replace('{{%','%#',$request->subject);
        $subject = str_replace('%}}','#%',$sub_replaced);

        $email_temp->name =       $request->name ;
        $email_temp->description =       $request->description;
        $email_temp->content =       $content;
        $email_temp->subject = $subject;
        $email_temp->save();

        return redirect('admin/emails/edit/'.$id)->with('status', 'success')->with('message', 'Successfully updated');

    }

    /**
     *  Show create form
     * @return type
     */
    public function getCreate()
    {
        $mode = 'create';
        
        return View('admin.emails.email_create_edit',compact('mode'));
    }
    
    /**
     * Show form for editing records
     * @param type $id
     * @return type
     */
    public function getEdit($id)
    {
        $mode = 'edit';
        $data = Email_temp::find($id);
        $content = $data->content;
        $subject_raw = $data->subject;
        $name = $data->name;
        $description = $data->description;
                   
        $sub_replaced = str_replace('%#','{{',$subject_raw);
        $subject = str_replace('#%','}}',$sub_replaced);
        
        $replaced = str_replace('%#','{{%',$content);
        $content = str_replace('#%','%}}',$replaced);
       
        $id = $data->id;
        $variables = $data->variables;
              
        return View('admin.emails.email_create_edit',compact('content','subject','id','variables','mode','name','description'));
    }

    /**
     *  Sent test email
     * @param type $id
     * @return type
     */
    public function sendTestEmail($id)
    {
        $data = Email_temp::find($id);

        $variables = $data->variables;

        $test_data['customer']     = 'Test customer';
        $test_data['product']      = 'Test product';
        $test_data['order_detail'] = 'Coffe cup';
        $test_data['price']        = 200;
        $test_data['order']        = '123456 Abc';

        if ($variables->first())
        {      
            foreach ($variables as $var)
            {
                if (isset($test_data[$var->name]))
                {
                    $stringtoreplace[] = '%#'.$var->name.'#%';
                    $replace[]         = $test_data[$var->name];
                }
            }

            $template['data'] = str_replace($stringtoreplace, $replace,
                $data->content);
            $subject          = str_replace($stringtoreplace, $replace,
                $data->subject);
        }
        else
        {
            $template['data'] = $data->content;
            $subject          = $data->subject;
        }

        Mail::send('admin.emails.template', $template,
            function($message) use($subject) {
            $message->to(Config::get('constants.TEST_EMAIL'), 'Test Mail')->subject($subject)->from(Config::get('constants.TEST_EMAIL'));
        });

        return redirect('admin/emails/edit/'.$id)->with('status', 'success')->with('message',
                'Email sent');
    }

    /**
     * Update record
     * @param Request $request
     * @return type
     */
    public function postCreate(Request $request)
    {
        $this->validate($request,
              [
              'name' => 'required',
              'subject' => 'required',
              'content' => 'required',
              'description' => 'required',
          ]);
        
        $email_temp              = new Email_temp;
        $email_temp->name        = $request->name;
        $email_temp->subject     = $request->subject;
        $email_temp->content     = $request->content;
        $email_temp->description = $request->description;

        $email_temp->save();

        return redirect('admin/emails/')->with('status', 'success')->with('message',
                'Template created');
    }
    /**
     * Delete record
     * @param Request $request
     * @return type
     */
    public function postDelete(Request $request)
    {
        $data = Email_temp::find($request->input('value'));

        if ($data)
        {
            $this->validate($request,
                [
                'value' => 'required|numeric',
            ]);

            $data->where('id', $request->input('value'))->delete();

            return response()->json(['status' => 'success']);
        } 
        else
        {
            return response()->json(['status' => 'error']);
        }
    }
    
}