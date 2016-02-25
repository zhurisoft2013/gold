<?php 
/**
* Excel操作
*/
/*

R('Excel/read', array($filetmpname));
// $excel=A('Excel');
// $excel= new \Admin\Controller\ExcelController;
// $excel->read($filetmpname);
 */
namespace Admin\Controller;
use Think\Controller;
class ExcelController extends Controller{
	public function __construct() {
		parent::__construct();//为了避免使用A方法产生一个错误
		Vendor('PHPExcel.PHPExcel');
	}

	/**
	 * [read description]读取excel文件
	 * @param  [type] $filename [description]
	 * @return [type]           [description]返回读取的数据数组
	 */
	public function read($filename){
		$file_types=explode(".",$filename);
      		$file_type=$file_types[count($file_types)-1];
      		if (strtolower($file_type) != "xlsx" && strtolower($file_type) != "xls") {
           			$this->error('不是Excel文件,无法读取!');
        		}
        		$objPHPExcel = \PHPExcel_IOFactory::load($filename);
		$arrExcel = $objPHPExcel->getSheet(0)->toArray();
		$fields=array_shift($arrExcel);
		foreach ($arrExcel as $key => $value) {
			$arrExcel[$key]=array_combine($fields, $value);
		}
		// dump($fields);
		// dump($arrExcel);
		return $arrExcel;
	}

	/**
	 * [add description]将数据存入数据库
	 * @param [type] $filename [description]
	 * @param [type] $table    [description]
	 */
	public function add($filename, $table){
		$model=D($table);
		if (empty($model)) {
			$this->error('表格模型建立错误！');
		}
		$data=$this->read($filename);
		$noInList=array();
		$success_count=0;
		foreach ($data as $key => $value) {
			$result=$model->create($value);
			if(false===$result){
				// $this->error($model->getError());
				$value['error']=$model->getError();
				$noInList[]=$value;
 			}else{
				if($model->add()){
					$success_count++;
					// $this->success('导入成功！','Blog/add');
					// echo '导入成功！' . '<br />' ;
				}else{
					//$this->error('导入失败！');
					// echo '导入失败' . $value['username'] .'<br />';
					$value['error']='导入失败';
					$noInList[]=$value;
				}
			}
			 
		
		}
		dump($noInList);
		$fields=array_keys($noInList[0]);
		// dump($fields);
		$this->exportExcel('result', $fields, $noInList, false);
		
	}

   /**
     * 导出数据到表格文件
     * @param $expFieldName  array  Column name
     * array(
     * 	array('username', '用户名'),
     * 	array('password', '密码'),
     * )
     * @param $expTableData array  Table data
     */
    public function exportExcel($fileName, $expFieldName, $expTableData, $browse=true) {
        // $expTitle='excel';
        // $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); //文件名称
        // $fileName = 'result' . date('_YmdHis'); //or $xlsTitle 文件名称可根据自己情况设定
        // Vendor("PHPExcel.PHPExcel.IOFactory");
        $cellNum = count($expFieldName); //列数
        $dataNum = count($expTableData); //行数

        $objPHPExcel = new \PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        //$objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1'); //合并单元格
        //$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . '  Export time:' . date('Y-m-d H:i:s'));
        
        //表格表头
        for ($i = 0; $i < $cellNum; $i++) {
        	// echo $expFieldName[$i];
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '1', $expFieldName[$i]);
        }
        // Miscellaneous glyphs, UTF-8   
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 2), $expTableData[$i][$expFieldName[$j]]);
                // echo  $expTableData[$i][$expFieldName[$j]];
            }
        }
        // $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        // $objWriter->save("xxx.xlsx");
         // $objWriter =\PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
         // $objWriter->save("xxx.xls");
       

        // header('pragma:public');
        // header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        // header("Content-Disposition:attachment;filename=$fileName.xls"); //attachment新窗口打印inline本窗口打印
        // // $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // $objWriter->save('php://output');

	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	if ($browse) {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
	}else{
		$fileFullName=TEMP_PATH . $fileName. '.xls' ;
		$objWriter->save($fileFullName);
		return $fileFullName;
	}

    }


}
 ?>