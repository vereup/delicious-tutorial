<?php

use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $seoulCountries = [
            '강남구',
            '강동구',
            '강북구',
            '강서구',
            '관악구',
            '광진구',
            '구로구',
            '금천구',
            '노원구',
            '도봉구',
            '동대문구',
            '동작구',
            '마포구',
            '서대문구',
            '서초구',
            '성동구',
            '성북구',
            '송파구',
            '양천구',
            '영등포구',
            '용산구',
            '은평구',
            '종로구',
            '중구',
            '중랑구'
        ];

        $gyeonggiCountries = [
            '가평군',
            '고양시덕양구',
            '고양시일산동구',
            '고양시일산서구',
            '과천시',
            '광명시',
            '광주시',
            '구리시',
            '군포시',
            '김포시',
            '남양주시',
            '동두천시',
            '부천시',
            '성남시분당구',
            '성남시수정구',
            '성남시중원구',
            '수원시권선구',
            '수원시영통구',
            '수원시장안구',
            '수원시팔달구',
            '시흥시',
            '안산시단원구',
            '안산시상록구',
            '안성시',
            '안양시동안구',
            '안양시만안구',
            '양주시',
            '양평군',
            '여주시',
            '연천군',
            '오산시',
            '용인시기흥구',
            '용인시수지구',
            '용인시처인구',
            '의왕시',
            '의정부시',
            '이천시',
            '파주시',
            '평택시',
            '포천시',
            '하남시',
            '화성시'
        ];

        $IncheonCountries = [
            '강화군',
            '계양구',
            '남동구',
            '동구',
            '미추홀구',
            '부평구',
            '서구',
            '연수구',
            '옹진군',
            '중구'
        ];

        $gangwonCountries = [
            '강릉시',
            '고성군',
            '동해시',
            '삼척시',
            '속초시',
            '양구군',
            '양양군',
            '영월군',
            '원주시',
            '인제군',
            '정선군',
            '철원군',
            '춘천시',
            '태백시',
            '평창군',
            '홍천군',
            '화천군',
            '횡성군'
        ];

        $chungcheongnamdoCountries = [
            '계룡시',
            '공주시',
            '금산군',
            '논산시',
            '당진시',
            '보령시',
            '부여군',
            '서산시',
            '서천군',
            '아산시',
            '예산군',
            '천안시',
            '청양군',
            '태안군',
            '홍성군'
        ];

        $daejeonCountries = [
            '대덕구',
            '동구',
            '서구',
            '유성구',
            '중구'
        ];

        $chungcheongbukdoCountries = [
            '괴산군',
            '단양군',
            '보은군',
            '영동군',
            '옥천군',
            '음성군',
            '제천시',
            '증평군',
            '진천군',
            '청주시상당구',
            '청주시서원구',
            '청주시청원구',
            '청주시흥덕구',
            '충주시',
        ];

        $busanCountries = [
            '강서구',
            '금정구',
            '기장군',
            '남구',
            '동구',
            '동래구',
            '부산진구',
            '북구',
            '사상구',
            '사하구',
            '서구',
            '수영구',
            '연제구',
            '영도구',
            '중구',
            '해운대구'
        ];

        $ulsanCountries = [
            '남구',
            '동구',
            '북구',
            '울주군',
            '중구'
        ];

        $daeguCountries = [
            '남구',
            '달서구',
            '달성군',
            '동구',
            '북구',
            '서구',
            '수성구',
            '중구'
        ];

        $gyeongsangbukdoCountries = [
            '경산시',
            '경주시',
            '고령군',
            '구미시',
            '군위군',
            '김천시',
            '문경시',
            '봉화군',
            '상주시',
            '성주군',
            '안동시',
            '영덕군',
            '영양군',
            '영주시',
            '영천시',
            '예천군',
            '울릉군',
            '울진군',
            '의성군',
            '청도군',
            '청송군',
            '칠곡군',
            '포항시남구',
            '포항시북구'
        ];

        $gyeongsangnamdoCountries = [
            '거제시',
            '거창군',
            '고성군',
            '김해시',
            '남해군',
            '밀양시',
            '사천시',
            '산청군',
            '양산시',
            '의령군',
            '진주시',
            '창녕군',
            '창원시',
            '통영시',
            '하동군',
            '함안군',
            '함양군',
            '합천군'
        ];

        $jeollanamdoCountries = [
            '강진군',
            '고흥군',
            '곡성군',
            '광양시',
            '구례군',
            '나주시',
            '담양군',
            '목포시',
            '무안군',
            '보성군',
            '순천시',
            '신안군',
            '여수시',
            '영광군',
            '영암군',
            '완도군',
            '장성군',
            '장흥군',
            '진도군',
            '함평군',
            '해남군',
            '화순군'
        ];

        $gwangjuCountries = [
            '광산구',
            '남구',
            '동구',
            '북구',
            '서구'
        ];

        $jeollabukdoCountries = [
            '고창군',
            '군산시',
            '김제시',
            '남원시',
            '무주군',
            '부안군',
            '순창군',
            '완주군',
            '익산시',
            '임실군',
            '장수군',
            '전주시',
            '정읍시',
            '진안군'
        ];

        $jejudoCountries = [
            '서귀포시',
            '제주시'
        ];

        foreach($seoulCountries as $seoulCounty){
            DB::table('counties')->insert([
                'city_id' => 1,
                'county' => $seoulCounty,
            ]);
        }

        foreach($gyeonggiCountries as $gyeonggiCounty){
            DB::table('counties')->insert([
                'city_id' => 2,
                'county' => $gyeonggiCounty,
            ]);
        }

        foreach($IncheonCountries as $IncheonCounty){
            DB::table('counties')->insert([
                'city_id' => 3,
                'county' => $IncheonCounty,
            ]);
        }

        foreach($gangwonCountries as $gangwonCounty){
            DB::table('counties')->insert([
                'city_id' => 4,
                'county' => $gangwonCounty,
            ]);
        }

        foreach($chungcheongnamdoCountries as $chungcheongnamdoCounty){
            DB::table('counties')->insert([
                'city_id' => 5,
                'county' => $chungcheongnamdoCounty,
            ]);
        }

        foreach($daejeonCountries as $daejeonCounty){
            DB::table('counties')->insert([
                'city_id' => 6,
                'county' => $daejeonCounty,
            ]);
        }

        foreach($chungcheongbukdoCountries as $chungcheongbukdoCounty){
            DB::table('counties')->insert([
                'city_id' => 7,
                'county' => $chungcheongbukdoCounty,
            ]);
        }

        DB::table('counties')->insert([
            'city_id' => 8,
            'county' => '세종시',
        ]);

        foreach($busanCountries as $busanCounty){
            DB::table('counties')->insert([
                'city_id' => 9,
                'county' => $busanCounty,
            ]);
        }

        foreach($ulsanCountries as $ulsanCounty){
            DB::table('counties')->insert([
                'city_id' => 10,
                'county' => $ulsanCounty,
            ]);
        }

        foreach($daeguCountries as $daeguCounty){
            DB::table('counties')->insert([
                'city_id' => 11,
                'county' => $daeguCounty,
            ]);
        }

        foreach($gyeongsangbukdoCountries as $gyeongsangbukdoCounty){
            DB::table('counties')->insert([
                'city_id' => 12,
                'county' => $gyeongsangbukdoCounty,
            ]);
        }

        foreach($gyeongsangnamdoCountries as $gyeongsangnamdoCounty){
            DB::table('counties')->insert([
                'city_id' => 13,
                'county' => $gyeongsangnamdoCounty,
            ]);
        }
        foreach($jeollanamdoCountries as $jeollanamdoCounty){
            DB::table('counties')->insert([
                'city_id' => 14,
                'county' => $jeollanamdoCounty,
            ]);
        }
        foreach($gwangjuCountries as $gwangjuCounty){
            DB::table('counties')->insert([
                'city_id' => 15,
                'county' => $gwangjuCounty,
            ]);
        }
        foreach($jeollabukdoCountries as $jeollabukdoCounty){
            DB::table('counties')->insert([
                'city_id' => 16,
                'county' => $jeollabukdoCounty,
            ]);
        }
        foreach($jejudoCountries as $jejudoCounty){
            DB::table('counties')->insert([
                'city_id' => 17,
                'county' => $jejudoCounty,
            ]);
        }





    }
}
