<?php
    require_once('../classes/config.php');
    require_once('../inc/fpdf17/fpdf.php');
    require_once('../classes/clsPosition.php');
    require_once('../classes/clsCandidate.php');
    require_once('../classes/clsVoter.php');
    require_once('../classes/clsCourse.php');
    //require_once('../classes/clsProgram.php');
    
    $votID1 = $_POST['vot_id'];
    $pdf = new FPDF('P','mm',array(114.3,330.2));
    
    $position = new Position();
    $position_rec = $position->getPosition(1);
    $candidate = new Candidate();
    $candidate_rec = $candidate->getRecordVoted(1,$votID1);
    
    
    
    $pdf->AddPage();
    $pdf->SetFont('Times','',11);
    $pdf->MultiCell(0,2,'University of Immaculate Conception',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,2,'Davao City, Philippines 8000',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,2,'Student Supreme Government Elections',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,3,'A.Y. 2012 - 2013',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,3,'OFFICIAL BALLOT',0,'C'); $pdf->Ln();
    
    $pdf->Rect(10,35,95,99,'D');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(10,8,"SSG Executive");
    $pdf->Ln();
    $z = 0;
    
    for($x=0;$x<count($position_rec);$x++)
    {
        $pdf->SetFont('Times','',10);
        $pdf->Cell(40,5,$position_rec[$x]['posName']);
        $ctr = count($candidate_rec);
        
        if(!empty($candidate_rec[$x]))
        {
            for($y=0;$y<count($candidate_rec);$y++)
            {
                    if($y < $ctr)
                    {
                        $posId1 = $position_rec[$x]['posID'];
                        $posId2 = $candidate_rec[$y]['id'];
                        if($posId1 == $posId2)
                        {
                            $pdf->SetFont('Times','I',9);
                            $pdf->Ln();
                            $pdf->Cell(40,5,' '.$candidate_rec[$y]['lname'].', '.$candidate_rec[$y]['fname']);
                        }
                    }   
            }
        }
        else {$pdf->Ln();}
        $pdf->Ln();
    }
    
    /*****************************************************************************************************/
    
    $position_rec = $position->getPosition(2);
    $candidate_rec = $candidate->getRecordVoted(2,$votID1);
    $pdf->Ln();    
    $pdf->Rect(10,135,95,108,'D');
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0,4,"Program");
    $pdf->Ln();
    
    for($x=0;$x<count($position_rec);$x++)
    {
        $pdf->SetFont('Times','',10);
        $pdf->Cell(40,5,$position_rec[$x]['posName']);
        $ctr = count($candidate_rec);
        if(!empty($candidate_rec[$x]))
        {
            for($y=0;$y<count($candidate_rec);$y++)
            {
                    if($y < $ctr)
                    {
                        $posId1 = $position_rec[$x]['posID'];
                        $posId2 = $candidate_rec[$y]['id'];
                        if($posId1 == $posId2)
                        {
                            $pdf->SetFont('Times','I',9);
                            $pdf->Ln();
                            $pdf->Cell(40,5,' '.$candidate_rec[$y]['lname'].', '.$candidate_rec[$y]['fname']);
                        }
                    }
            }
        }
        else {$pdf->Ln();}
        $pdf->Ln();
        
    }
    $voterDtl = new Voter();
    $name = $voterDtl->searchVoter($votID1);
    
    $courseDtl = new Course();
    $course = $courseDtl->getVotersCourse($votID1);
    
    $program = new Program();
    $progName = $program->getStudentProgram($votID1);
    
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Times','',10);
    $pdf->MultiCell(0,5,'---------------------------Voters Information---------------------------',0,'C');
    $pdf->Cell(10,5,'ID No.  '.$votID1); $pdf->Ln();
    $pdf->Cell(10,5,'Name  '.$name[0]['vot_lname'].', '.$name[0]['vot_fname']); $pdf->Ln();
    $pdf->Cell(10,5,'Course  '.$course[0]['course']); $pdf->Ln();
    $pdf->Cell(10,5,'Program  '.$progName[0]['progName']); $pdf->Ln();
    $pdf->Cell(10,5,'Date/Time Printed  '); $pdf->Ln();
    $pdf->Cell(10,7,'The undersigned hereby certify that all information provided'); $pdf->Ln();
    $pdf->Cell(10,4,'herein are true and correct.'); $pdf->Ln();$pdf->Ln();
    $pdf->Cell(10,5,'_______________________________'); $pdf->Ln();
    $pdf->Cell(10,4,'Voters Signature');
    
    $pdf->Output();

?>
