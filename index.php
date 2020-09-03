<?php 
    echo('Линейное уравнение: 5х + 15 = 0<br>');
    echo(linear(5, -15));
    echo('Квадратное уравнение: 5x^2 - 3x - 15 = 0<br>');   
    echo(quad(5, -3, -15));
    echo('Кубическое уравнение: x^3 + 5x^2 - 3x - 15 = 0<br>');
    echo(cubic(5, -3, -15));

    //ax = b
    function linear($a, $b){
        if ($a != 0){
            return 'X='.(string)$b / $a.'<br>';
        }elseif ($b == 0) {
            return "На ноль делить нельзя!<br>";
        }
    }
    //ax^2 + bx + c = 0
    function quad($a, $b, $c){
        if ($a==0){
            return "Ошибка, а=0 недопустимое значение<br>";
        }
        $D=$b*$b-4*$a*$c;
        if ($D>0) {
            $x1=(-$b+sqrt($D))/(2*$a);
            $x2=(-$b-sqrt($D))/(2*$a);
            return "X1=".(string)$x1."<br> X2=".(string)$x2.'<br>';
        }elseif ($D==0){
            $x1=-$b/(2*$a);
            return "X=".(string)$x1.'<br>';
        }elseif ($D<0){
            return "Корней нет, D<0<br>";	
        }
    }
    
/* Cubic equation solution. Real coefficients case.

   int Cubic(double *x,double a,double b,double c);
   Parameters:
   x - solution array (size 3). On output:
       3 real roots -> then x is filled with them;
       1 real + 2 complex -> x[0] is real, x[1] is real part of 
                             complex roots, x[2] - non-negative 
                             imaginary part.
   a, b, c - coefficients, as described 
   Returns: 3 - 3 real roots;
            1 - 1 real root + 2 complex;
            2 - 1 real root + complex roots imaginary part is zero 
                (i.e. 2 real roots). 
*/
        //ax^3 + bx^2 + cx + d = 0
        function cubic($a, $b, $c) {
            $M_2PI = 2. * M_PI;

            $q=($a*$a-3.*$b)/9.; 
            $r=($a*(2.*$a*$a-9.*$b)+27.*$c)/54.;
            $r2=$r*$r; 
            $q3=$q*$q*$q;
            if($r2 < $q3) {
                $t=acos($r/sqrt($q3));
                $a/=3.; 
                $q=-2.*sqrt($q);
                $x[0]=$q*cos($t/3.)-$a;
                $x[1]=$q*cos(($t+$M_2PI)/3.)-$a;
                $x[2]=$q*cos(($t-$M_2PI)/3.)-$a;
                $strok = 'X1 ='.(string)$x[0].'<br>  X2 ='.(string)$x[1].'<br>  X3 ='.(string)$x[2].'<br>';
                return $strok;
            }
            else {
                if($r<=0.){
                    $r=-$r;
                }
                $aa=-pow($r+sqrt($r2-$q3),1./3.); 
                if($aa!=0.) {
                    $bb=$q/$aa;
                }
                else {
                    $bb=0.;
                } 
                $a/=3.; 
                $q=$aa+$bb; 
                $r=$aa-$bb; 
                $x[0]=$q-$a;
                $x[1]=(-0.5)*$q-$a;
                $x[2]=(sqrt(3.)*0.5)*abs($r);
                if($x[2]==0.) {
                    return 'X1 ='.(string)$x[0].'<br>  X2 ='.(string)$x[1].'<br>';
                }
                return 'X1 ='.(string)$x[0].'<br>';
            }
        }