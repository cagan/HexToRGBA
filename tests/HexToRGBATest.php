<?php


use App\HexToRGBAConverter;
use PHPUnit\Framework\TestCase;


class HexToRGBATest extends TestCase
{

    /**
     * @test
     * @throws Exception
     */
    public function it_should_throw_exception_when_digit_count_not_valid()
    {
        $this->expectException(Exception::class);

        $hexCode = '#1A3A';
        HexToRGBAConverter::convert($hexCode);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_throw_exception_then_square_symbol_in_wrong_place()
    {
        $this->expectException(Exception::class);

        $hexCode = '12#F';
        HexToRGBAConverter::convert($hexCode);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_convert_when_3_digits_entered()
    {
        $hexCode = '#37C';

        $this->assertEquals('rgba(51, 119, 204, 1)', HexToRGBAConverter::convert($hexCode));
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_convert_when_6_digits_entered()
    {
        $hexCode = '#37CAA7';

        $this->assertEquals('rgba(55, 202, 167, 1)', HexToRGBAConverter::convert($hexCode));
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_convert_when_square_symbol_not_entered()
    {
        $hexCode = '37CAA7';

        $this->assertEquals('rgba(55, 202, 167, 1)', HexToRGBAConverter::convert($hexCode));
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_convert_when_lower_case_character_entered()
    {
        $hexCode = '#81cd12';

        $this->assertEquals('rgba(129, 205, 18, 1)', HexToRGBAConverter::convert($hexCode));
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_throw_exception_when_alpha_out_of_range()
    {
        $this->expectException(InvalidArgumentException::class);

        $hexCode = '#81cd12';
        $alpha = 2;

        $this->assertEquals('rgba(129, 205, 18, 1)', HexToRGBAConverter::convert($hexCode, $alpha));
    }
    
    /**
     * @test
     * @throws Exception
     */
    public function it_should_drop_zero_from_start_in_alpha_number()
    {
        $hexCode = '#81cd12';
        $alpha = 0.3;

        $this->assertEquals('rgba(129, 205, 18, .3)', HexToRGBAConverter::convert($hexCode, $alpha));
    }
}

