<?php



// ��� ������� ���������� false, ���� ��������� ���� ������ �� ��������� (����. ������ ��� �������)
// ���� - ������ ��� ����������� ������ ������� ������.

function installmod_where() { return "`whois`!='' AND (`whois` LIKE '%\001%' OR `whois` LIKE '%".e('|')."%')"; }

function installmod_init() {
    if(!ms("SELECT COUNT(*) FROM `dnevnik_comm` WHERE ".installmod_where(),"_l",0)) return false;
    return "��������� whois";
}

// ��� ������� - ���� ������ ������. ���� ������ �� ������� ������ - ������� 0,
// ����� ������� ����� �������, � ������� ���������� ������, ����� �� ������ ������� ����������.
// skip - � ���� ��������, allwork - ����� ���������� (�������� �����), $o - ��, ��� ������ �� �����.
function installmod_do() { global $o,$skip,$allwork,$delknopka; $starttime=time();



// 48126) ERROR [�������] Bangkok

$flgs=array(
'����������� ����������� �������������� � �������� ��������'             =>'UK',
'���'                                                           =>'AE',
'��������'                                                                    =>'MD',
'������� ����������'                                                                      =>'CZ',
'����������'                                                                 =>'BY',
'���������'                                                                 =>'BY',
'��������'                                                                 =>'BY',
'Russia'=>'RU',
'Russian Federation'=>'RU',
'russia'=>'RU',
'RUSSIA'=>'RU',
'RUSSIAN FEDERATION'=>'RU',
'�������'                                                                    =>'AD',
'�������� �������'                                                           =>'AE',
'����������'                                                                 =>'AF',
'������� � �������'                                                          =>'AG',
'�������'                                                                    =>'AI',
'�������'                                                                    =>'AL',
'���������� �-��'                                                            =>'AN',
'������'                                                                     =>'AO',
'����������'                                                                 =>'AQ',
'���������'                                                                  =>'AR',
'������������ �����'                                                         =>'AS',
'�������'                                                                    =>'AT',
'���������'                                                                  =>'AU',
'�������'                                                                    =>'AM',
'�����'                                                                      =>'AW',
'�����������'                                                                =>'AZ',
'������ � �����������'                                                       =>'BA',
'��������'                                                                   =>'BB',
'���������'                                                                  =>'BD',
'�������'                                                                    =>'BE',
'�������-����'                                                               =>'BF',
'��������'                                                                   =>'BG',
'�������'                                                                    =>'BH',
'�������'                                                                    =>'BI',
'�����'                                                                      =>'BJ',
'�������'                                                                    =>'BM',
'������'                                                                     =>'BN',
'�������'                                                                    =>'BO',
'��������'                                                                   =>'BR',
'������'                                                                     =>'BS',
'�����'                                                                      =>'BT',
'�-� �����'                                                                  =>'BV',
'��������'                                                                   =>'BW',
'����������'                                                                 =>'BY',
'�����'                                                                      =>'BZ',
'������'                                                                     =>'CA',
'���������� �����'                                                           =>'CD',
'����������-����������� ����������'                                          =>'CF',
'�����'                                                                      =>'CG',
'���������'                                                                  =>'CH',
'���-�`�����'                                                                =>'CI',
'�-�� ����'                                                                  =>'CK',
'����'                                                                       =>'CL',
'�������'                                                                    =>'CM',
'�����'                                                                      =>'CN',
'��������'                                                                   =>'CO',
'�����-����'                                                                 =>'CR',
'����'                                                                       =>'CU',
'����-�����'                                                                 =>'CV',
'����'                                                                       =>'CY',
'�����'                                                                      =>'CZ',
'��������'                                                                   =>'DE',
'�������'                                                                    =>'DJ',
'�����'                                                                      =>'DK',
'��������'                                                                   =>'DM',
'������������� ����������'                                                   =>'DO',
'���������'                                                   =>'DO',
'�����'                                                                      =>'DZ',
'�������'                                                                    =>'EC',
'�������'                                                                    =>'EE',
'������'                                                                     =>'EG',
'�������'                                                                    =>'ER',
'�������'                                                                    =>'ES',
'�������'                                                                    =>'ET',
'������'                                                                     =>'EU',
'���������'                                                                  =>'FI',
'�����'                                                                      =>'FJ',
'������������ �-��'                                                          =>'FK',
'����������'                                                                 =>'FM',
'��������� �-��'                                                             =>'FO',
'�������'                                                                    =>'FR',
'�����'                                                                      =>'GA',
'�������'                                                                    =>'GD',
'������'                                                                     =>'GE',
'����'                                                                       =>'GH',
'���������'                                                                  =>'GI',
'����������'                                                                 =>'GL',
'������'                                                                     =>'GM',
'������'                                                                     =>'GN',
'���������'                                                                  =>'GP',
'�������������� ������'                                                      =>'GQ',
'������'                                                                     =>'GR',
'���������'                                                                  =>'GT',
'����'                                                                       =>'GU',
'������-�����'                                                               =>'GW',
'������'                                                                     =>'GY',
'�������'                                                                    =>'HK',
'�-�� ���� � ����������'                                                     =>'HM',
'��������'                                                                   =>'HN',
'��������'                                                                   =>'HR',
'�����'                                                                      =>'HT',
'�������'                                                                    =>'HU',
'���������'                                                                  =>'ID',
'��������'                                                                   =>'IE',
'�������'                                                                    =>'IL',
'�����'                                                                      =>'IN',
'���������� ���������� � ��������� ������'                                   =>'IO',
'����'                                                                       =>'IQ',
'����'                                                                       =>'IR',
'��������'                                                                   =>'IS',
'������'                                                                     =>'IT',
'italy'                                                                     =>'IT',
'Italy'                                                                     =>'IT',
'������'                                                                     =>'JM',
'��������'                                                                   =>'JO',
'������'                                                                     =>'JP',
'�����'                                                                      =>'KE',
'����������'                                                                 =>'KG',
'��������'                                                                 =>'KG',
'��������'                                                                   =>'KH',
'��������'                                                                   =>'KI',
'��������� �-��'                                                             =>'KM',
'����-���� � �����'                                                          =>'KN',
'�������� �����'                                                             =>'KP',
'����� �����'                                                                =>'KR',
'�����'                                                                =>'KR',
'������'                                                                     =>'KW',
'���������� �-��'                                                            =>'KY',
'���������'                                                                  =>'KZ',
'����'                                                                       =>'LA',
'�����'                                                                      =>'LB',
'����-�����'                                                                 =>'LC',
'�����������'                                                                =>'LI',
'���-�����'                                                                  =>'LK',
'�������'                                                                    =>'LR',
'������'                                                                     =>'LS',
'�����'                                                                      =>'LT',
'����������'                                                                 =>'LU',
'������'                                                                     =>'LV',
'�����'                                                                      =>'LY',
'�������'                                                                    =>'MA',
'������'                                                                     =>'MC',
'�������'                                                                    =>'MD',
'����������'                                                                 =>'MG',
'���������� �-��'                                                            =>'MH',
'���������'                                                                  =>'MK',
'����'                                                                       =>'ML',
'������'                                                                     =>'MM',
'��������'                                                                   =>'MN',
'�����'                                                                      =>'MO',
'�������� ���������� �-��'                                                   =>'MP',
'���������'                                                                  =>'MQ',
'����������'                                                                 =>'MR',
'����c�����'                                                                 =>'MS',
'������'                                                                     =>'MT',
'��������'                                                                   =>'MU',
'��������'                                                                   =>'MV',
'������'                                                                     =>'MW',
'�������'                                                                    =>'MX',
'��������'                                                                   =>'MY',
'��������'                                                                   =>'MZ',
'�������'                                                                    =>'NA',
'����� ���������'                                                            =>'NC',
'�����'                                                                      =>'NE',
'�-� �������'                                                                =>'NF',
'�������'                                                                    =>'NG',
'���������'                                                                  =>'NI',
'����������'                                                                 =>'NL',
'���������'                                                                 =>'NL',
'��������'                                                                   =>'NO',
'�����'                                                                      =>'NP',
'�����'                                                                      =>'NR',
'����� ��������'                                                             =>'NZ',
'����'                                                                       =>'OM',
'������'                                                                     =>'PA',
'����'                                                                       =>'PE',
'����������� ���������'                                                      =>'PF',
'����� - ����� ������'                                                       =>'PG',
'���������'                                                                  =>'PH',
'��������'                                                                   =>'PK',
'������'                                                                     =>'PL',
'���-���� � �������'                                                         =>'PM',
'������-����'                                                                =>'PR',
'���������'                                                                  =>'PS',
'����������'                                                                 =>'PT',
'�����'                                                                      =>'PW',
'��������'                                                                   =>'PY',
'�����'                                                                      =>'QA',
'�-� �������'                                                                =>'RE',
'�������'                                                                    =>'RO',
'������'                                                                     =>'RU',
'������'                                                                     =>'RW',
'���������� ������'                                                          =>'SA',
'���������� �-��'                                                            =>'SB',
'�������'                                                                    =>'SC',
'Seychelles'                                                                    =>'SC',
'�����'                                                                      =>'SD',
'������'                                                                     =>'SE',
'��������'                                                                   =>'SG',
'��������'                                                                   =>'SI',
'��������'                                                                   =>'SK',
'������-�����'                                                               =>'SL',
'���-������'                                                                 =>'SM',
'�������'                                                                    =>'SN',
'������'                                                                     =>'SO',
'�������'                                                                    =>'SR',
'���-���� � ��������'                                                        =>'ST',
'����'                                                                       =>'SU',
'���������'                                                                  =>'SV',
'�����'                                                                      =>'SY',
'���������'                                                                  =>'SZ',
'�-�� ����� � ������'                                                        =>'TC',
'���'                                                                        =>'TD',
'����������� ����� ����������'                                               =>'TF',
'����'                                                                       =>'TG',
'�������'                                                                    =>'TH',
'�������'                                                                    =>'TH',
'�����������'                                                                =>'TJ',
'������������'                                                               =>'TM',
'�����'                                                                      =>'TN',
'�����'                                                                      =>'TO',
'��������� �����'                                                            =>'TP',
'������'                                                                     =>'TR',
'�������� � ������'                                                          =>'TT',
'������'                                                                     =>'TV',
'�������'                                                                    =>'TW',
'��������'                                                                   =>'TZ',
'�������'                                                                    =>'UA',
'������'                                                                     =>'UG',
'��������������'                                                             =>'UK',
'����� �-�� ���'                                                             =>'UM',
'���'                                                                        =>'US',
'�������'                                                                    =>'UY',
'����������'                                                                 =>'UZ',
'�������'                                                                    =>'VA',
'���-������� � ���������'                                                    =>'VC',
'���������'                                                                  =>'VE',
'���������� �-�� (��������)'                                                 =>'VG',
'���������� �-�� (���)'                                                      =>'VI',
'�������'                                                                    =>'VN',
'�������'                                                                    =>'VU',
'�����'                                                                      =>'WS',
'�����'                                                                      =>'YE',
'���������'                                                                  =>'YU',
'����� ������'                                                               =>'ZA',
'������'                                                                     =>'ZM',
'����'                                                                       =>'ZR',
'��������'                                                                   =>'ZW');


	while((time()-$starttime)<2 && $skip<$allwork) {
		$pp=ms("SELECT `id`,`whois` FROM `dnevnik_comm` WHERE ".installmod_where()." LIMIT 100","_a",0);
		foreach($pp as $p) { $s=$p['whois']; $ok=0;
		    if($s=="\001") { $c=''; $ok=1; }

		    elseif(strstr($s,'|')) { list($country,$city,)=explode('|',$s,3); 
if(strlen($country)>2) idie("Error len: ".h($country));
$c=$country.' '.$city; $ok=1; }

		    elseif(strstr($s,"\001")) { list($city,$c,)=explode("\001",$s,2);
if(isset($flgs[$c])) { $ok=1; $country=$flgs[$c]; }
elseif($city=='Montenegro') { $city=''; $country='ME'; $ok=1; }
elseif($city=='Santa Clara') { $country='CU'; $ok=1; }
elseif($city=='Wholesale') { $ok=-1; }
else $country='ERROR ['.h($c).']';
$c=$country.' '.$city; }
		    else $c="ERROR";

		    if($ok==1) msq_update('dnevnik_comm',array('whois'=>e($c)),"WHERE `id`='".$p['id']."'");
		    elseif($ok==-1) msq_update('dnevnik_comm',array('whois'=>''),"WHERE `id`='".$p['id']."'");
		    else $o.="<div>".$p['id'].") ".h($c)."</div>".$GLOBALS['msqe'];
		}
		usleep(100000);
		$skip+=100;
	}

	$o.=" ".$skip;
	if($skip<$allwork) return $skip;
	$delknopka=1;
	return 0;
}

// ���������� ����� ����� ����������� ������ (����. ����� ������� � ���� ��� ���������).
// ���� ������ ������������ ������� - ������� 0.
function installmod_allwork() { return ms("SELECT COUNT(*) FROM `dnevnik_comm` WHERE ".installmod_where(),"_l",0); }

?>