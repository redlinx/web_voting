<?php
    require_once('../libraries/classes/config.php');
    require_once('../libraries/inc/fpdf17/fpdf.php');
    require_once('../libraries/classes/clsPosition.php');
    require_once('../libraries/classes/clsCandidate.php');
    require_once('../libraries/classes/clsVoter.php');
    require_once('../libraries/classes/clsCourse.php');
    //require_once('../classes/clsProgram.php');
    
    $votID1 = $_GET['vid'];
    $pdf = new FPDF('P','mm',array(114.3,330.2));
    
    $position = new Position();
    $position_rec = $position->getPosition(1);
    $candidate = new Candidate();
    $candidate_rec = $candidate->getRecordVoted(1,$votID1);
    
    
    $pdf->AddPage();
    $pdf->SetFont('Times','',11);
    $pdf->MultiCell(0,2,'University of Immaculate Conception',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,2,'Student Supreme Government Elections',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,3,'A.Y. 2012 - 2013',0,'C'); $pdf->Ln();
    $pdf->MultiCell(0,3,'OFFICIAL BALLOT',0,'C'); $pdf->Ln();
    $pdf->Rect(10,30,95,285,'D');
    $pdf->SetFont('Times','B',12);
    $pdf->MultiCell(0,5,"SSG Executive",1,'C');
    $pdf->Ln();
    $z = 0;
    
    for($x=0;$x<count($position_rec);$x++)
    {
        $pdf->SetFont('Times','',10);
        $pdf->Cell(40,5,$position_rec[$x]['posName']);
        $ctr = count($candidate_rec);
        
            for($y=0;$y<count($candidate_rec);$y++)
            {
                    if($y < $ctr)
                    {
                        $posId1 = $position_rec[$x]['posID'];
                        $posId2 = $candidate_rec[$y]['id'];
                        if($posId1 == $posId2)
                        {
                            $pdf->SetFont('Times','B',9);
                            $pdf->Ln();
                            $pdf->Cell(40,5,' '.$candidate_rec[$y]['lname'].', '.$candidate_rec[$y]['fname']);
                        }
                    }   
            }
        
        $pdf->Ln();
    }
    
    /*****************************************************************************************************/
    
    $position_rec = $position->getPosition(2);
    $candidate_rec = $candidate->getRecordVoted(2,$votID1);
    $pdf->Ln();    
    $pdf->SetFont('Times','B',12);
    $pdf->MultiCell(0,5,"Program Officers",1,'C');
    $pdf->Ln();
    
    for($x=0;$x<count($position_rec);$x++)
    {
        $pdf->SetFont('Times','',10);
        $pdf->Cell(40,5,$position_rec[$x]['posName']);
        $ctr = count($candidate_rec);
            for($y=0;$y<count($candidate_rec);$y++)
            {
                    if($y < $ctr)
                    {
                        $posId1 = $position_rec[$x]['posID'];
                        $posId2 = $candidate_rec[$y]['id'];
                        if($posId1 == $posId2)
                        {
                            $pdf->SetFont('Times','B',9);
                            $pdf->Ln();
                            $pdf->Cell(40,5,' '.$candidate_rec[$y]['lname'].', '.$candidate_rec[$y]['fname']);
                        }
                    }
            }
        $pdf->Ln();
        
    }
    $voterDtl = new Voter();
    $voterDtl->updateBallotTimePrinted($votID1);
    $name = $voterDtl->searchVoter($votID1);
    
    $courseDtl = new Course();
    $course = $courseDtl->getVotersCourse($votID1);
    
    $program = new Program();
    $progCode = $program->getStudentProgram($votID1);
    $pdf->Ln();
    $pdf->SetFont('Times','B',10);
    $pdf->MultiCell(0,5,'Voters Information',1,'C');
    $pdf->SetFont('Times','',10);
    $pdf->Ln();
    $pdf->Cell(10,4,'ID No.  '.$votID1); $pdf->Ln();
    $pdf->Cell(10,4,'Name  '.$name[0]['votLname'].', '.$name[0]['votFname']); $pdf->Ln();
    $pdf->Cell(10,4,'Course  '.$course[0]['course']); $pdf->Ln();
    $pdf->Cell(10,4,'Program  '.$progCode[0]['progCode']); $pdf->Ln();
    $pdf->Cell(10,4,'Date/Time Printed  '.$name[0]['ballotLog']); $pdf->Ln(); $pdf->Ln();
    $pdf->Cell(10,5,'The undersigned hereby certify that all information provided'); $pdf->Ln();
    $pdf->Cell(10,4,'herein are true and correct.'); $pdf->Ln();$pdf->Ln();
    $pdf->Cell(10,5,'_______________________________'); $pdf->Ln();
    $pdf->Cell(10,4,'Voters Signature');
    
    $pdf->Output();

?>