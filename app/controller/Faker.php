<?php


namespace app\controller;


use app\common\service\ErrCodeService;

class Faker
{
    private $faker;
    private $addressCode;
    protected $weightingFactor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    /**
     * 校验码
     * @var [type]
     */
    protected $checkCode = [1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2];

    public function __construct()
    {
        $cardInfo = include __DIR__ . '/../GB2260.php';//引入身份证地址码
        $this->addressCode = array_keys($cardInfo);
        $this->faker = \Faker\Factory::create('zh_CN');//设置中文字符
        $this->faker->setDefaultTimezone('PRC');//默认时区
    }

    public function run()
    {
        //TODO Faker\Provider\Base 基本
        ec($this->faker->randomDigit);//生成0-9之间的随机数
        ec($this->faker->randomDigitNotNull);//生成1-9之间的随机数
        ec($this->faker->randomNumber(5,false));//生成5位整数，true表示严格模式，即只能5位,false表示在5个左右
        ec($this->faker->randomFloat(2,10,20));//生成浮点数，两位小数点，范围是10-20之间
        ec($this->faker->numberBetween(10,20));//生成10-20之前的数字
        ec($this->faker->randomLetter);//返回a-z之间任意的一个小写字符
        dd($this->faker->randomKey(['name'=>'yqx','age'=>24,'sex'=>'nv']));//返回数组中的随机下标
        ec($this->faker->randomElement([1,2,3,4]));//返回数组中的随机一个元素
        dd($this->faker->randomElements([1,2,3,4,5],2,true));//返回数组中两个元素,false表示不允许重复元素出现，true可出现重复元素
        ec($this->faker->shuffle('My name is yqx'));//打乱字符串，返回字符
        dd($this->faker->shuffle([1,2,3,4,5]));//打乱数组，返回数组格式
        ec($this->faker->numerify('yqx###'));//返回3个随机数字，#代表随机数字
        ec($this->faker->lexify('yqx???'));//返回3个随机字符，？代表字符
        ec($this->faker->bothify('#?'));//可以同时返回字符和数字
        ec($this->faker->asciify('**'));//*替换为随机字符，输出类似：$l
        ec($this->faker->regexify('\w{2,5}@\w{2}\.\w{3,4}'));//根据正则表达式返回字串
        ec($this->faker->toLower('YQX'));//字符转大写
        ec($this->faker->toUpper('yqx'));//字符转小写
        dd($this->faker->valid(function($digit){
            return fmod($digit,2) == 1;
        })->numberBetween(1,100));//筛选器，返回1-100之间的奇数
        ec($this->faker->unique()->name('female'));//female：女生名，male：男生名
        //TODO Faker\Provider\Lorem 文本
        ec($this->faker->word);//返回一个单词
        dd($this->faker->words(2,true));//返回两个单词，false：返回数组，true：返回字符串
        dd($this->faker->sentence(5,false));//返回5个单词，false：只能5个，true：5个左右
        dd($this->faker->sentences(3,true));//返回3条句子，false：返回数组，true：返回字符串
        dd($this->faker->paragraph(3,true));////返回3条句子，false表示返回一个数组，true表示将三条句子拼成一条返回
        dd($this->faker->paragraphs(4,false));//返回4个段落。false表示返回一个数组，true表示将段落拼接在一起，并且用换行符分割
        dd($this->faker->text(100));
        //TODO Faker\Provider\en_US\Text 文本
        dd($this->faker->realText());//返回Text下的内容，中文
        //TODO Faker\Provider\zh_CN\Person 人物
        ec($this->faker->title('female'));///参数：title($gender = null|'male'|'female') .返回称呼：如：夫人
        ec($this->faker->name('female'));//返回名字，女性名字
        ec($this->faker->firstName);//参数：firstName($gender = null|'male'|'female') .返回名
        ec($this->faker->lastName);//返回姓氏
        //TODO Faker\Provider\en_US\Address 地址
        ec($this->faker->state);//返回省份/州：如陕西省
        ec($this->faker->stateAbbr);//省份简称.如：晋、蒙、浙、冀
        ec($this->faker->buildingNumber);//建筑物编号,如：56
        ec($this->faker->city);//返回省份直辖市：长沙
        ec($this->faker->postcode);//邮政编码
        ec($this->faker->address);//地址（城市+区）:南昌海港区
        ec($this->faker->country);//国家名：玻利维亚
        ec($this->faker->latitude);//纬度
        ec($this->faker->longitude);//经度
        //TODO Faker\Provider\en_US\PhoneNumber 电话号码
        ec($this->faker->phoneNumber);//手机号码
        ec($this->faker->e164PhoneNumber);//电话号码
        //TODO Faker\Provider\en_US\Company 公司
        ec($this->faker->company);//公司名字：戴硕电子信息有限公司
        ec($this->faker->companyPrefix);//公司名称前缀：时空盒数字
        ec($this->faker->companySuffix);//公司名称后缀：网络有限公司
        ec($this->faker->catchPhrase);//公司口号：放低偏见，你会有出色发现！
        //TODO Faker\Provider\DateTime 日期时间
        ec(date('Y-m-d H:i:s', $this->faker->unixTime));//返回随机时间戳
        ec(date('Y-m-d H:i:s', $this->faker->unixTime('now')));//返回随机时间戳,最大时间不超过现在
        dd($this->faker->dateTime('now', 'PRC'));//返回一个不超过现在时间的DateTime对象
        dd($this->faker->iso8601);//返回随机的字符串形式的时间
        dd($this->faker->iso8601('now'));//范湖随机字符形式时间，可选最后截止时间
        dd($this->faker->date('Y-m-d H:i:s', 'now'));//返回指定格式时间，可选择最后截止时间(2009-1-1)
        dd($this->faker->dateTimeBetween('1997-1-1', 'now', 'PRC'));//返回指定时间区间的DateTime对象，可选时区
        dd($this->faker->dateTimeInInterval('-5 years', '+5 days', '-RC'));//以现在时间为基础时间（2021-3-19），-5年并+5天，返回：2016-03-24
        dd($this->faker->dateTimeThisDecade('2020-1-1', 'PRC'));//返回一个前10内的DateTime对象
        dd($this->faker->dateTimeThisYear);//返回这一年内的DateTime对象
        dd($this->faker->dateTimeThisMonth);//返回这一个月前内的DateTime对象
        dd($this->faker->amPm);//返回一个时间是上午、下午
        dd($this->faker->dayOfMonth('now'));//返回几号：27
        dd($this->faker->dayOfWeek('now'));//返回星期几:星期四
        dd($this->faker->monthName('now'));//返回月份名称：一月
        dd($this->faker->year);//返回年份：1986
        dd($this->faker->timezone);//返回随机时区：America/Recife
        //TODO Faker\Provider\Internet 互联网
        ec($this->faker->email);//返回随机邮箱：iste_ipsam@qq.com
        ec($this->faker->freeEmail);//返回一个随机邮箱
        ec($this->faker->safeEmail);//返回一个以@example.com结尾的安全邮箱
        ec($this->faker->freeEmailDomain);//返回一个邮箱域名：sina.com
        ec($this->faker->safeEmailDomain);//返回一个安全的邮箱域名：example.net
        ec($this->faker->userName);//返回一个用户名：voluptate61
        ec($this->faker->password);//返回一个密码:vT70GA+
        ec($this->faker->password(3,8));//返回一个最小3，最大8长度的密码：0gPq
        ec($this->faker->tld);//域名后缀：如com、org
        ec($this->faker->ipv4);//返回ipv4地址：174.178.10.177
        ec($this->faker->ipv6);//返回ipv6地址：e6fc:2ca5:921:d2d4:a89a:c677:940f:5411
        ec($this->faker->macAddress);//返回mac地址：69:6F:C0:98:0B:EB
        ec($this->faker->url);//返回一个url地址：http://www.yan.edu.cn/，需要开启intl扩展
        ec($this->faker->domainName);//返回一个域名：luan.com
        ec($this->faker->domainWord);//不带后缀的域名
        //TODO Faker\Provider\Payment 支付
        ec($this->faker->creditCardNumber);//信用卡号：4485749252309
        ec($this->faker->creditCardType);//信用卡类型：Visa
        dd($this->faker->creditCardExpirationDate);//卡片过期时间，DateTime对象
        ec($this->faker->creditCardExpirationDateString);//卡片过期时间：09/21
        dd($this->faker->creditCardDetails);//信用卡详细信息，数组：type，number，name，expirationDate
        ec($this->faker->iban);//国际银行账户：PS66TOCZ9P40L885Y2A482P2L6GK1
        ec($this->faker->bank);//银行名字：广发银行
        //TODO Faker\Provider\Color 颜色
        ec($this->faker->hexColor);//十六进制随机颜色：#d3d91a
        ec($this->faker->rgbColor);//RGBg格式随机颜色：106,174,210
        dd($this->faker->rgbColorAsArray);//RGB格式颜色，数组形式
        ec($this->faker->rgbCssColor);//返回css样式RGB格式：rgb(213,233,2)
        ec($this->faker->safeColorName);//一个安全的随机颜色：水色
        ec($this->faker->colorName);//孔雀绿
        //TODO Faker\Provider\File 文件
        ec($this->faker->fileExtension);//文件后缀：gif
        ec($this->faker->mimeType);//mime类型：application/json
        //目录路径需要写绝对地址，且复制目录不能为空目录，将目录中的文件复制到yqx目录中，返回全路径名
        ec($this->faker->file(__DIR__.'/test',__DIR__.'/yqx'));
        ec($this->faker->file(__DIR__.'/test',__DIR__.'/yqx',false));//返回复制生成后的文件名
//        TODO Faker\Provider\Uuid UUID
        ec($this->faker->uuid);//生成一个uuid：a8a3d6d3-0154-3494-bbf7-84af3b41f58e
        //TODO Faker\Provider\Miscellaneous 各种各样的
        dd($this->faker->boolean);
        dd($this->faker->randomHtml(5,8));
        ec($this->faker->chrome);
    }

    /**
     * 生成身份证`
     * @access public
     * @param integer $quantity [description]
     * @return [type]            [description]
     */
    public function createIdcard($quantity = 1)
    {
        $num = 0;

        $return = [];

        while ($num < $quantity) {
            // 地址码,6位数字
            $code = $this->faker->randomElement($this->addressCode);
            // 出生日期码  max为最大生成限制，8位数字
            $birth = $this->faker->date($format = 'Ymd', $max = '1990-01-01');
            // 顺序码
            $orderCode = $this->faker->numberBetween($min = 111, $max = 999);

            $idcard = $code . $birth . $orderCode;
            $sum = 0;
            // 校验码
            foreach (str_split($idcard) as $key => $value) {
                $sum += $value * $this->weightingFactor[$key];
            }
            $remainder = $sum % 11;
            $idcard .= $this->checkCode[$remainder];

            $return[] = $idcard;

            $num++;
        }
        return $return;
    }
}