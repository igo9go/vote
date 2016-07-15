<?php
 header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data.csv"');
header('Cache-Control: max-age=0');

$stmt = $data['list'];
// 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

// 输出Excel列名信息
/*$head = array("id", "姓名");
each ($head as $i => $v) {
	// 	CSV的Excel支持GBK编码，一定要转换，否则乱码
				            $head[$i] = iconv('utf-8', 'gbk', $v);
}
*/

// 计数器
        $cnt = 0;
// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;

// 逐行取出数据，不浪费内存
        $count = count($stmt);
for ($t = 0; $t < $count; $t++) {
	
	$cnt++;
	if ($limit == $cnt) {
		//刷		新一下输出buffer，防止由于数据过多造成问题
								                ob_flush();
		//把		这些数据写入到更低层，并且缓冲区会被清空
								                flush();
		$cnt = 0;
	}
	$row = $stmt[$t];
	foreach ($row as $i => $v) {
		$row[$i] = iconv('utf-8', 'gbk', $v);
	}
	fputcsv($fp, $row);
}
