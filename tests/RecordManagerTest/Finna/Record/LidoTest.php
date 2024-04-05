<?php

/**
 * Finna LIDO Record Driver Test Class
 *
 * PHP version 7
 *
 * Copyright (C) Eero Heikkinen 2013.
 * Copyright (C) The National Library of Finland 2017-2023.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category DataManagement
 * @package  RecordManager
 * @author   Eero Heikkinen <eero.heikkinen@gmail.com>
 * @author   Ere Maijala <ere.maijala@helsinki.fi>
 * @author   Juha Luoma <juha.luoma@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://github.com/NatLibFi/RecordManager
 */

namespace RecordManagerTest\Finna\Record;

use RecordManager\Finna\Record\Lido;

/**
 * Finna LIDO Record Driver Test Class
 *
 * @category DataManagement
 * @package  RecordManager
 * @author   Eero Heikkinen <eero.heikkinen@gmail.com>
 * @author   Ere Maijala <ere.maijala@helsinki.fi>
 * @author   Juha Luoma <juha.luoma@helsinki.fi>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     https://github.com/NatLibFi/RecordManager
 */
class LidoTest extends \RecordManagerTest\Base\Record\RecordTestBase
{
    /**
     * Test Musketti LIDO record handling
     *
     * @return void
     */
    public function testMusketti1()
    {
        $fields = $this->createRecord(Lido::class, 'musketti1.xml', [], 'Finna')
            ->toSolrArray();

        $this->assertContains('metalli', $fields['material']);
        $this->assertContains('kupari', $fields['material']);

        $this->assertContains(
            'ruokatalous ja elintarviketeollisuus',
            $fields['classification_txt_mv']
        );
        $this->assertContains('ruoan valmistus', $fields['classification_txt_mv']);
        $this->assertContains(
            'työkalut ja välineet',
            $fields['classification_txt_mv']
        );
        $this->assertContains(
            'astiat ja välineet',
            $fields['classification_txt_mv']
        );
        $this->assertContains('kahvipannu', $fields['classification_txt_mv']);

        $this->assertContains('taloustarvikkeet', $fields['topic']);
        $this->assertContains('nautintoaineet', $fields['topic']);
        $this->assertContains('kahvi', $fields['topic']);
        $this->assertContains('suomalais-ugrilaiset kansat', $fields['topic']);
        $this->assertContains('saamelaiset', $fields['topic']);
        $this->assertContains('porolappalaiset', $fields['topic']);
        $this->assertContains('pannut', $fields['topic']);
        $this->assertContains('kahvipannut', $fields['topic']);
        $this->assertContains('Toimija, Toini', $fields['topic']);

        $this->assertEquals('kahvipannu', $fields['title']);

        $this->assertEquals('Suomen kansallismuseo/KM', $fields['institution']);

        $this->assertEquals('S3168:23', $fields['identifier']);

        $this->assertEquals(
            'Kuparinen, mustunut ja kolhiintunut poromiesten käyttämä kahvipannu.',
            $fields['description']
        );

        $this->assertContains(
            'korkeus, suurin 12.50, halkaisija 13 cm',
            $fields['measurements']
        );

        $this->assertContains('saamelaiset', $fields['culture']);

        $this->assertEquals(
            'http://muisti.nba.fi/m/S3168_23/sa009218.jpg',
            $fields['thumbnail']
        );

        $this->assertEquals(
            'Seurasaaren ulkomuseon kokoelmat',
            $fields['collection']
        );

        $this->assertEquals('esine', $fields['format']);

        $this->assertContains('Utsjoki, Lappi', $fields['allfields']);
        $this->assertContains('teollinen tuote', $fields['allfields']);
        $this->assertContains('Museovirasto/MV', $fields['allfields']);
        $this->assertEquals(['image/jpeg'], $fields['media_type_str_mv']);
    }

    /**
     * Test Musketti LIDO record handling
     *
     * @return void
     */
    public function testMusketti2()
    {
        $fields = $this->createRecord(Lido::class, 'musketti2.xml', [], 'Finna')
            ->toSolrArray();
        unset($fields['fullrecord']);

        $expected = [
            'record_format' => 'lido',
            'title_full' => 'Imatrankoski',
            'title_short' => 'Imatrankoski',
            'title' => 'Imatrankoski',
            'title_sort' => 'imatrankoski',
            'title_alt' => [],
            'format' => 'kuva',
            'institution' => 'Museoviraston kuva-arkisto/',
            'author' => [
                'Testaaja, Taavi, suunnittelija',
                'Hintze Harry, kuvaaja',
            ],
            'author_sort' => 'Testaaja, Taavi, suunnittelija',
            'topic_facet' => [],
            'topic' => [],
            'topic_id_str_mv' => [],
            'material' => [],
            'material_str_mv' => [],
            'era_facet' => [
                '1897', '1898',
            ],
            'era' => [
                '1897', '1898',
            ],
            'geographic_facet' => [
                'Ruokolahti',
                'Imatrankoski, Ruokolahti',
                'Kalasatama',
                'Capellanranta 1 ja 3 välillä',
                'Helsinki',
                'Imatrankoski',
                'Ruokolahti',
            ],
            'geographic' => [
                'Ruokolahti',
                'Imatrankoski, Ruokolahti',
                'Kalasatama',
                'Capellanranta 1 ja 3 välillä',
                'Helsinki',
            ],
            'geographic_id_str_mv' => [
                '(prt)Prt',
                '(kiinteistötunnus)Kiinteistötunnus',
                'http://www.yso.fi/onto/yso/p94413',
            ],
            'collection' => 'Kansatieteen kuvakokoelma',
            'thumbnail' => 'http://muisti.nba.fi/m/4878_1/00013199.jpg',
            'allfields' => [
                'Luonto',
                'musketti_www.M012:4878:1',
                'kuva',
                'valokuva',
                'fi',
                'sv',
                'en',
                'Imatrankoski',
                '33,1.',
                'Imatra. val. H.Hintze 1897 Antr.',
                '33,1.',
                'Imatra. 1897',
                '33,1. Imatra.',
                'Museoviraston kuva-arkisto/',
                '4878:1',
                'Prt',
                'Kiinteistötunnus',
                'http://www.yso.fi/onto/yso/p94413',
                'Tarkempi paikka veden äärellä',
                'Kalasatama',
                'Capellanranta 1 ja 3 välillä',
                'Helsinki',
                'valmistus',
                'Hintze Harry',
                '1897',
                '1897',
                '1897',
                'Ruokolahti',
                'suunnittelu',
                'Testaaja, Taavi',
                'Imatrankoski',
                '1897',
                '1898',
                'Imatrankoski, Ruokolahti',
                'Imatrankoski',
                'luonnon paikka',
                'Ruokolahti ..',
                'kunta/kaupunki (Suomi)',
                'Museovirasto',
                'Hintze Harry',
                '4878:1',
                '4878:1',
                'Museovirasto/MV',
                'Museovirasto/MV',
                'Kansatieteen kuvakokoelma',
                'Museovirasto/MV',
            ],
            'identifier' => '4878:1',
            'measurements' => [
                '12 x 17 cm, 12 cm',
            ],
            'culture' => [],
            'rights' => 'Museovirasto/MV',
            'artist_str_mv' => [],
            'photographer_str_mv' => [],
            'finder_str_mv' => [],
            'manufacturer_str_mv' => [],
            'designer_str_mv' => ['Testaaja, Taavi'],
            'classification_str_mv' => [
                'valokuva',
            ],
            'classification_txt_mv' => [
                'valokuva',
            ],
            'exhibition_str_mv' => [],
            'main_date_str' => '1897',
            'main_date' => '1897-01-01T00:00:00Z',
            'search_daterange_mv' => [
                '[1897-01-01 TO 1897-12-31]',
                '[1897-01-01 TO 1897-12-31]',
            ],
            'creation_daterange' => '[1897-01-01 TO 1897-12-31]',
            'source_str_mv' => '__unit_test_no_source__',
            'datasource_str_mv' => '__unit_test_no_source__',
            'online_boolean' => '1',
            'online_str_mv' => '__unit_test_no_source__',
            'free_online_boolean' => '1',
            'free_online_str_mv' => '__unit_test_no_source__',
            'location_geo' => [],
            'center_coords' => '',
            'usage_rights_str_mv' => [
                '',
            ],
            'usage_rights_ext_str_mv' => [
                '',
            ],
            'author_facet' => [
                'Testaaja, Taavi',
                'Hintze Harry',
            ],
            'format_ext_str_mv' => [
                'kuva',
            ],
            'hierarchy_parent_title' => [
                'Kansatieteen kuvakokoelma',
            ],
            'category_str_mv' => [
                'Luonto',
            ],
            'ctrlnum' => [],
            'isbn' => [],
            'issn' => [],
            'language' => [
                'fi',
                'sv',
                'en',
            ],
            'media_type_str_mv' => [
                'image/jpeg',
            ],
            'identifier_txtP_mv' => [
                '4878:1',
                'Prt',
                'Kiinteistötunnus',
            ],
        ];

        $this->compareArray($expected, $fields, 'toSolrArray');
    }

    /**
     * Test Lusto LIDO record handling
     *
     * @return void
     */
    public function testLusto1()
    {
        $fields = $this->createRecord(Lido::class, 'lusto1.xml', [], 'Finna')
            ->toSolrArray();

        $this->assertEquals('E01025:3', $fields['identifier']);

        $this->assertContains('muovi, metalli', $fields['material']);

        $this->assertContains('istutus', $fields['topic']);
        $this->assertContains('kantovälineet', $fields['topic']);
        $this->assertContains('metsänhoito', $fields['topic']);
        $this->assertContains('metsänviljely', $fields['topic']);
        $this->assertContains('metsätalous', $fields['topic']);

        $this->assertEquals(
            '[1980-01-01 TO 1999-12-31]',
            $fields['creation_daterange']
        );

        $this->assertEquals('Esine', $fields['format']);

        $this->assertContains(
            'pituus 65 cm, leveys 55 cm, korkeus enimmillään 26 cm',
            $fields['measurements']
        );
        $this->assertEquals(
            [
                'image/tiff',
                'image/png',
            ],
            $fields['media_type_str_mv']
        );
    }

    /**
     * Test VTM LIDO record handling
     *
     * @return void
     */
    public function testVtm1()
    {
        $fields = $this->createRecord(Lido::class, 'vtm1.xml', [], 'Finna')
            ->toSolrArray();

        $this->assertContains('kangas', $fields['material']);
        $this->assertContains('öljy', $fields['material']);

        $this->assertContains('maalaus', $fields['classification_txt_mv']);

        $this->assertEquals('Venetsia', $fields['title']);

        $this->assertEquals('Ateneumin taidemuseo', $fields['institution']);

        $this->assertEquals('A V 4724', $fields['identifier']);

        $this->assertContains('41 x 51 cm', $fields['measurements']);

        $this->assertEquals(
            'http://ndl.fng.fi/ndl/zoomview/muusa01/0051A721-E48D-42B4-BD02'
                . '-98D8C4681A50.jpg',
            $fields['thumbnail']
        );

        $this->assertEquals('Richter', $fields['collection']);

        $this->assertEquals('maalaus', $fields['format']);

        $this->assertEquals(['Salokivi, Santeri, taiteilija'], $fields['author']);
        $this->assertEquals(
            '[1911-01-01 TO 1911-12-31]',
            $fields['creation_daterange']
        );
        $this->assertEquals(['image/jpeg'], $fields['media_type_str_mv']);
    }

    /**
     * Test Tuusula LIDO record handling
     *
     * @return void
     */
    public function testTuusula1()
    {
        $fields = $this->createRecord(Lido::class, 'tuusula1.xml', [], 'Finna')
            ->toSolrArray();

        $this->assertContains('kangas', $fields['material']);
        $this->assertContains('pahvi', $fields['material']);
        $this->assertContains('öljy', $fields['material']);

        $this->assertContains('maalaus', $fields['classification_txt_mv']);

        $this->assertEquals('Rantakiviä', $fields['title']);

        $this->assertEquals('Tuusulan taidemuseo', $fields['institution']);

        $this->assertEquals(
            'Rantamaisema, jonka matalassa vedessä näkyy maalauksen etuosassa'
            . ' punervanharmaita kiviä sekä rantakalliota harmaansinisen vaalean'
            . ' veden rannalla. Taustana pelkää vettä, mikä valtaa suurimman osa'
            . ' kuva-alasta. Veden kuvaus heijastuksineen on kiinnostanut Pekka'
            . ' Halosta koko hänen taiteellisen uransa aikana. Hänen viimeisten'
            . ' vuosien maisemissa vesiaiheet ovat lähinnä rantaviivojen, vesien ja'
            . ' jäänpinnan heijastusten kuvauksia. Horisontti on usein laskenut'
            . ' hyvin alas, sitä tuskin enää näkyy ollenkaan, kuten tässä teoksessa.'
            . ' Halosen maisemat muuttuvat yhä seesteisemmiksi ja pelkistetyimmiksi',
            $fields['description']
        );

        $this->assertEquals('Tla TM T 374', $fields['identifier']);

        $this->assertNotContains('25H112', $fields['topic']);
        $this->assertNotContains(
            'Rantamaisema, jonka matalassa vedessä näkyy maalauksen etuosassa'
            . ' punervanharmaita kiviä sekä rantakalliota harmaansinisen vaalean'
            . ' veden rannalla. Taustana pelkää vettä, mikä valtaa suurimman osa'
            . ' kuva-alasta.',
            $fields['topic']
        );

        $this->assertContains('50 x 41 cm', $fields['measurements']);

        $this->assertEquals(
            'http://ndl.fng.fi/ndl/zoomview/muusa24/3D313279-45A5-469A-885E'
            . '-766C66F0F6DC.jpg',
            $fields['thumbnail']
        );

        $this->assertEquals(
            'Pekka Halosen seuran kokoelma / Antti Halosen kokoelma',
            $fields['collection']
        );

        $this->assertContains(
            'Pystymetsän Pekka. Pekka Halosen maalauksia vuosilta 1887-1932.'
            . ' Halosenniemi, Tuusula 17.4.-17.10.2010',
            $fields['exhibition_str_mv']
        );

        $this->assertEquals('maalaus', $fields['format']);

        $this->assertEquals(['Halonen, Pekka, taiteilija'], $fields['author']);
        $this->assertEquals(
            '[1930-01-01 TO 1930-12-31]',
            $fields['creation_daterange']
        );
        $this->assertEquals(['image/jpeg'], $fields['media_type_str_mv']);
    }

    /**
     * Test Design Museum LIDO record handling
     *
     * @return void
     */
    public function testDesign1()
    {
        $fields = $this->createRecord(Lido::class, 'design1.xml', [], 'Finna')
            ->toSolrArray();

        $this->assertEquals('Kuva', $fields['format']);

        $this->assertEquals(
            'aterimet; lusikka, haarukka, veitsi; Triennale',
            $fields['title']
        );
        $this->assertEquals([], $fields['title_alt']);

        $this->assertEquals('45106', $fields['identifier']);

        $this->assertContains('ruostumaton teräs', $fields['material']);

        $this->assertEquals('Designmuseo', $fields['institution']);

        $this->assertEquals([], $fields['media_type_str_mv']);
    }

    /**
     * Test work identification keys
     *
     * @return void
     */
    public function testWorkIdentificationKeys()
    {
        $record = $this->createRecord(Lido::class, 'lido_workkeys.xml', [], 'Finna');

        $expected = [
            [
                'titles' => [
                    ['type' => 'title', 'value' => 'Rantakiviä; litteitä; muu'],
                    ['type' => 'title', 'value' => 'Shore Stones'],
                ],
                'authors' => [
                    ['type' => 'author', 'value' => 'Halonen, Pekka'],
                ],
                'titlesAltScript' => [],
                'authorsAltScript' => [],
            ],
        ];

        $this->compareArray($expected, $record->getWorkIdentificationData(), 'getWorkIdentificationData');
    }

    /**
     * Test measurements
     *
     * @return void
     */
    public function testMeasurements()
    {
        $record = $this->createRecord(
            Lido::class,
            'lido_measurements.xml',
            [],
            'Finna'
        );

        $expected = [
            'record_format' => 'lido',
            'title_full' => 'lierihattu',
            'title_short' => 'lierihattu',
            'title' => 'lierihattu',
            'title_sort' => 'lierihattu',
            'allfields' => [
                'M123',
                'lierihattu',
                '',
            ],
            'measurements' => [
                'korkeus 8.50 cm',
                'korkeus 8.50 cm (kuvun pystysuora osa edestä ja takaa)',
                'korkeus 9 cm (kuvun pystysuora osa sivulta)',
                'halkaisija, suurin 18.50 cm (kuvun päällys)',
                'halkaisija, pienin 15.00 cm (kuvun päällys)',
                'leveys 5.50 cm (lieri, lierin reuna)',
                'leveys 5.70 cm (lieri, lierin reuna)',
                'korkeus 9 cm, kuvun pystysuora osa sivulta',
            ],
            'source_str_mv' => '__unit_test_no_source__',
            'datasource_str_mv' => '__unit_test_no_source__',
            'format_ext_str_mv' => [
                '',
            ],
        ];

        $result = array_filter($record->toSolrArray());
        $this->compareArray($expected, $result, 'Measurements');
    }

    /**
     * Test getOtherIdentifiers function
     *
     * @return void
     */
    public function testIdentifiers(): void
    {
        $record = $this->createRecord(
            Lido::class,
            'lido_identifiers.xml',
            [],
            'Finna'
        );

        $data = $record->toSolrArray();
        $this->compareArray(
            [
                'this is a proper issn',
            ],
            $data['issn'],
            'issnCompare'
        );
        $this->compareArray(
            [
                '9783161484100',
            ],
            $data['isbn'],
            'isbnCompare'
        );
        $this->assertEquals('ID for identifier field', $data['identifier']);
        $this->compareArray(
            [
                'ID for identifier field',
                'Kissat kehdossa',
                'Hopealusikka',
                'Kattila',
                'Catila',
                'Kissala',
                'Kollila',
                'Manulila',
            ],
            $data['identifier_txtP_mv'],
            'OtherIdentifiers'
        );
    }

    /**
     * Test hierarchical locations from lido.
     *
     * @return void
     */
    public function testHierarchicalLocations(): void
    {
        $record = $this->createRecord(
            Lido::class,
            'lido_locations.xml',
            [],
            'Finna'
        );
        $result = ($record instanceof Lido) ? $record->getLocations() : [];
        $expected = [
            'primary' => [
                'Pohjantie, Karjaa, Etelä-Uusimaa, Suomi',
                'Kaivontie, Karjaa, Etelä-Uusimaa, Suomi',
                'Männiköntie, Karjaa, Etelä-Uusimaa, Suomi',
                'Suomi, Hamina',
                'Suomi, Mäntyharju',
                'S-market Mäntyharju',
            ],
            'secondary' => [
                'Håkansbölen kartano, Hakunila, Vantaa, Suomi',
                'Vaasa',
                'Ristimäenkatu 5, Mikkeli, Etelä-Savo, Suomi',
                'Ahmatie 1, Helsinki',
            ],
        ];
        $this->compareArray($expected, $result, 'Locations');
    }
}
